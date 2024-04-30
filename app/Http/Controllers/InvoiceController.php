<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
class InvoiceController extends Controller
{
    public function index()
    {
        $status="Billed";
        $orders = Order::where('status' , $status )->get();
        $invoices = Invoice::orderBy('created_at' , 'DESC')->get();
        return view('invoice.index')->with('invoices',$invoices)
        ->with('orders',$orders);
    }

    public function invoicesTrashed()
    {
        $invoices = Invoice::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('invoice.trashed')->with('invoices',$invoices);
    }

    public function create( $id)
    {
        $order = Order::where('id' , $id )->first();
        return view('invoice.create')->with('order',$order);
    }


    public function store(Request $request, $id)
    {

       $request->validate([
        'detail'=>'required',
        'amount'=>'required',
    ]);
            $a= $request->get('amount');
            $d= $request->get('discount');
            if($d == null)
                $d=0;
            $dValue= $a*($d/100);
            $t=$a-$dValue;
            $order = Order::find( $id ) ;
            $data = $request->input();
            try{
                $invoice = new Invoice;
                $invoice->detail = $data['detail'];
                $invoice->amount = $data['amount'];
                $invoice->discount = $d;
                $invoice->total = $t;
                $invoice->user_id =Auth::user()->id;
                $invoice->user_name =Auth::user()->name;
                $invoice->order_id = $id;
                $invoice->customer_name = $order->customer_name;
                $invoice->save();
                $order->status = 'Billed';
                $order->save();
                $orders = Order::where('status' , 'Finished' )->get();
                return view('accountantdash')->with('orders',$orders)
                    ->with('success','invoice created successflly') ;
            }

            catch(Exception $e){
                return redirect()->back()
                ->with('failed',"Failed") ;
            }
    }


    public function show( $id)
    {
        $invoice = Invoice::where('id' , $id )->first();
        $oid=$invoice->order_id;
        $order = Order::where('id' , $oid )->first();
        return view('invoice.show')->with('invoice' , $invoice)
        ->with('order' , $order);
    }

    public function itemsorder( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();

        return view('invoice.itemsorder')->with('order' , $order)->with('itemso' , $itemso);
    }



    public function edit( $id)
    {

        $invoice = Invoice::where('id' , $id )->first();
        if ($invoice === null) {
           return redirect()->back() ;
       }
       return view('invoice.edit')->with('invoice',$invoice);
    }


    public function update(Request $request, $id)
    {
        $invoice = Invoice::find( $id ) ;
        $oid =  $invoice->order_id;
        $request->validate([
            'detail'=>'required',
            'amount'=>'required',
            'discount'=>'required'

        ]);
            $a= $request->amount;
            $d= $request->discount;
            $dValue= $a*($d/100);
            $t=$a-$dValue;

        $invoice->detail = $request->detail;
        $invoice->amount = $request->amount;
        $invoice->discount = $request->discount;
        $invoice->total = $t;
        $invoice->user_id =Auth::user()->id;
        $invoice->user_name =Auth::user()->name;
        $invoice->order_id = $oid;
        $invoice->save();
        return redirect()->route('invoices')
        ->with('success','invoice Edited successflly') ;
    }


    public function destroy($id)
    {
        $invoice = Invoice::where('id' , $id )->first();
        if ($invoice === null) {
           return redirect()->back() ;
       }

        $invoice->delete($id);
        return redirect()->back()
        ->with('success','invoice deleted successflly') ;
    }

    public function hdelete( $id)
    {
        $invoice = Invoice::withTrashed()->where('id' ,  $id )->first() ;
        $invoice->forceDelete();
        return redirect()->back() ;
    }

    public function restore( $id)
    {
        $invoice = Invoice::withTrashed()->where('id' ,  $id )->first() ;
        $invoice->restore();
        return redirect()->back() ;
    }

    public function export($id)
    {   $invoice = Invoice::where('id' , $id )->first();
        $oid=$invoice->order_id;
        $order = Order::where('id' , $oid )->first();

        $data=[
            'invoice_id'=>$invoice->id,
            'created_at'=>$invoice->created_at->toFormattedDateString(),
            'item_name'=>$order->item_name,
            'quantity'=>$order->quantity,
            'item_price'=>$order->item->price,
            'amount'=>$invoice->amount,
            'discount'=>$invoice->discount,
            'total'=>$invoice->total,
            'user_name'=>$invoice->user_name,
            'order_id'=>$order->id,
            'customer_name'=>$invoice->customer_name
            ];
        $pdf = PDF::loadView('invoice.pdf',compact('data'));
        return $pdf->download('invoice'.$id.'.pdf');
    }
}
