<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use PDF;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at' , 'DESC')->get();
        return view('order.index')->with('orders',$orders);
    }
    public function indexPerStatus($status)
    {
        $orders = Order::Where('status',$status)
            ->orderBy('created_at' , 'DESC')->get();
        return view('order.index')->with('orders',$orders);
    }
    public function approve($id)
    {

        $order = Order::find( $id ) ;
        $order->status = 'new';
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully') ;
    }

    public function confirm()
    {
        $orders = Order::orderBy('created_at' , 'DESC')->where('status', 'Confirm' )->get();
        return view('order.confirm')->with('orders',$orders);
    }

    public function ordersTrashed()
    {
        return ("rest");
        $orders = Order::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('order.trashed')->with('orders',$orders);
    }

    public function create()
    {

       // return view('order.create');
        $items = DB::table('items')->get(array('name'));
        $customers = Customer::all();
        return view('order.create')->with(['items' => $items, 'customers' => $customers]);


//        $item = Item::all();
//        if($item->count() == 0) {
//            return redirect()->route('item.create');
//        }
//        return view('order.create')->with('item' ,  $item);

    }

    function action(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Customer::select('name')
                        ->where('name', 'LIKE', '%'.$query.'%')
                        ->get();

        return response()->json($filter_data);
    }

    function action2(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Item::where('name', 'LIKE', '%'.$query.'%')
                        ->get();

        return response()->json($filter_data);
    }


    public function store(Request $request)
    {

      $request->validate([
        'itemQuantity'=>'required',
           'itemName' =>  'required',
           ]);

           $customerName= $request->customerName;
           $customer = Customer::where('name', $customerName)->first();

        try{
                $order = new Order;
                    $oi = new OrderItem;

                    if($customer){
                        $order->customer_id = $customer->id;
                    }

                    $order->customer_name = $customerName;
                    $order->discount =  $request->discount ;
                    $order->discount_type =  $request->discountType;
                    $order->tax = $request->tax;
            $order->tax_type =  $request->taxType;
            $order->sub_total = $request->subtotal;
                    $order->total = $request->total ;
                    $order->status = "PendingCustomerApprovment";
                    $order->customer_notes = $request->notes ;
                    $order->user_id =Auth::user()->id;
                    $order->user_name =Auth::user()->name;
                    $order->save();

                    for ($a = 0; $a < count($_REQUEST["itemName"]); $a++)
                        {

                            $itemID = NULL;

                            $item = Item::where('name', $_REQUEST["itemName"][$a])->first();
                            if($item){
                                $itemID = $item->id;
                            }
                            if ($request->has('itemFile')){
                            if($request->itemFile[$a]){
                            $itemfile = $request->itemFile[$a];

                            $newfile = $itemfile->getClientOriginalName();

                            $itemfile->move('uploads/orders/'.$order->id.'/', $newfile);
                            $itemfile =  'uploads/orders/'.$order->id.'/'.$newfile;

                            }}
                            $rate = $_REQUEST["itemRate"][$a];
                            $quantity = $_REQUEST["itemQuantity"][$a];



                             DB::table('order_items')->insert(
                                array('order_id' => $order->id,
                                    'item_id' => $itemID,
                                  'item_name' => $_REQUEST["itemName"][$a],
                                  'quantity' =>  $quantity, 'rate' => $rate,
                                  'attached_file' => isset($itemfile)? $itemfile : null)
                            );


                        }
                        return redirect()->route('orders')
                        ->with('success','order added successfully') ;
		    }

			    catch(Exception $e){
                return redirect()->back()
                ->with('failed','operation failed') ;
			}
    }



    public function show( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();

        return view('order.show')->with('order' , $order)->with('itemso' , $itemso);
    }


    public function estimate( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();

        return view('order.estimate')->with('order' , $order)
        ->with('itemso' , $itemso);
    }

    public function export($id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();
        $data=[
            'order_id'=>$id,
            'created_at'=>$order->created_at->toFormattedDateString(),
            'item_name'=>$order->item_name,
            //'quantity'=>$order->quantity,
           // 'item_price'=>$order->rate,
           'discount'=>$order->discount,
            'tax'=>$order->tax,
            'total'=>$order->total,
            'user_name'=>$order->user_name,
            'customer_name'=>$order->customer_name,
            'customer_email' => isset($order->customer->email)? $order->customer->email : null,
            ];

        $pdf = PDF::loadView('order.pdf',compact('order','itemso'));
        return $pdf->download('order'.$id.'.pdf');
    }


    public function edit( $id)
    {
        $items = Item::all();
        $itemso = OrderItem::all()->where('order_id', $id);
        $order = Order::where('id' , $id )->first();
        if ($order === null) {
           return redirect()->back() ;
       }
       return view('order.edit')->with('order',$order)->with('itemso',$itemso)
       ->with('items',$items);
    }


    public function update(Request $request, $id)
    {
        $order = Order::find( $id ) ;
        $request->validate([

            'status'=>'required',
            'item_name'=>'required',
    ]);
        $order->status = $request->status;
        $order->customer_name = $request->customer;
        $customerName = $request->customer;
        $customer = Customer::where('name', $customerName)->first();
        if( $customer){
            $order->customer_id = $customer->id;
        }
        $order->user_id =Auth::user()->id;
        $order->user_name =Auth::user()->name;
        $order->discount =  $request->discount ;
        $order->tax = $request->tax ;
        $order->total = $request->total ;
        $order->customer_notes = $request->notes ;

        $order->save();


                        for ($a = 0; $a < count($_REQUEST["item_name"]); $a++)
                        {
                            $itemID = NULL;

                            $item = Item::where('name', $_REQUEST["item_name"][$a])->first();
                            if($item){
                                $itemID = $item->id;
                            }

                            $id = $_REQUEST["itemoid"][$a];


                            if ($request->has('itemFile')) {

                          $itemfile = $request->itemFile[$a];

                            $newfile = $itemfile->getClientOriginalName();

                            $itemfile->move('uploads/orders/items', $newfile);
                            $itemfile =  'uploads/orders/items/'.$newfile;

                            }

                            DB::table('order_items')
                                  ->where('id', intval($id))
                                  ->update(array('item_id' => $itemID,'order_id' => $order->id  , 'rate' => $_REQUEST["rate"][$a],
                                   'item_name' => $_REQUEST["item_name"][$a],
                                  'quantity' =>   $_REQUEST["quantity"][$a], 'attached_file' => $itemfile)
                            );


                        }


        return redirect()->route('orders')
        ->with('success','order Edited successfully') ;
    }
//---------------------------------------------------------------------------------------------------------
public function editconfirm( $id)
{
    $items = Item::all();
    $itemso = OrderItem::all()->where('order_id', $id);
    $order = Order::where('id' , $id )->first();
    if ($order === null) {
       return redirect()->back() ;
   }
   return view('order.editconfirm')->with('order',$order)->with('itemso',$itemso)
   ->with('items',$items);
}


public function updateconfirm(Request $request, $id)
{
    $order = Order::find( $id ) ;


                    for ($a = 0; $a < count($_REQUEST["itemoid"]); $a++)
                    {
                        $ido = $_REQUEST["itemoid"][$a];

                        if ($request->has('itemFile')) {

                            $itemfile = $request->itemFile[$a];

                            $newfile = $itemfile->getClientOriginalName();

                            $itemfile->move('uploads/orders/items', $newfile);
                            $itemfile =  'uploads/orders/items/'.$newfile;

                            }

                            DB::table('order_items')
                            ->where('id', intval($ido))
                            ->update(array( 'design_file' => $itemfile)
                        );


                    }


    return redirect()->route('order.confirm')
    ->with('success','Design Edited successfully') ;
}


//------------------------------------------------------------------------------------------------------

    public function destroy($id)
    {
        $order = Order::where('id' , $id )->first();
        if ($order === null) {
           return redirect()->back() ;
       }

        $order->delete($id);
        return redirect()->back()
        ->with('success','order deleted successfully') ;
    }

    public function hdelete( $id)
    {
        $order = Order::withTrashed()->where('id' ,  $id )->first();
        $order->forceDelete();
        $orderItems = OrderItem::withTrashed()->where('order_id',$id)->get();
        foreach ($orderItems as $orderItem)
            $orderItem->forceDelete();
        return redirect()->back() ;
    }

    public function restore( $id)
    {
        $order = Order::withTrashed()->where('id' ,  $id )->first() ;
        $order->restore();
        return redirect()->back() ;
    }

    public function designerorders( $id)
    {
        $order = Order::where('designer_id' , $id )->whereIn('status', array('inDesign','approved'))->get();


        $myordersCount = Order::where('designer_id' , $id)->whereIn('status', array('inDesign','approved'))->count();
        return view('designerorders')->with('order' , $order)->with('myordersCount',$myordersCount);
    }

    public function itemsorder( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();


        $myordersCount = Order::where('designer_id' , $id)->where('status','inDesign')->count();

        return view('designeritemsorder')->with('order' , $order)->with('itemso' , $itemso)->with('myordersCount',$myordersCount);
    }

    public function designeraccept( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'inDesign';
        $order->designer_id = Auth::user()->id;
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully') ;
    }

    public function retry( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'inDesign';
        $order->save();
        return redirect()->back()
            ->with('success','order in Process ') ;
    }

    public function finish( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'approved';
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully ') ;
    }

    public function designerend( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Designed';
        $order->save();
        return redirect()->route('dashboard')
            ->with('success','The order is send to printworker') ;
    }

    public function designersubmit(Request $request, $id)
    {

        $this->validate($request,[
            'itemFile' =>  'required',
        ]);

        $order = Order::find( $id ) ;
        $order->status = 'Confirm';
        $order->save();

         for ($a = 0; $a < count($_REQUEST["item_name"]); $a++)
        {
            $ido = $_REQUEST["itemoid"][$a];

            if ($request->has('itemFile')) {

                $itemfile = $request->itemFile[$a];

                  $newfile = $itemfile->getClientOriginalName();

                  $itemfile->move('uploads/orders/items', $newfile);
                  $itemfile =  'uploads/orders/items/'.$newfile;

                  }

                  DB::table('order_items')
                  ->where('id', intval($ido))
                  ->update(array( 'design_file' => $itemfile)
            );
        }
            return redirect()->route('dashboard')
                ->with('success','The Order is submitted for checked from Customer') ;

    }

    public function designercancel( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'New';
        $order->designer_id =null;
        $order->save();
        return redirect()->route('dashboard')
            ->with('success','order canceled successfully') ;
    }

    public function orderPhotoDownload($id)
    {
        $order_items = OrderItem::find( $id );
        $path1 = public_path($order_items->design_file);
        if( file_exists($path1))
           { return response()->download($path1);}

        else
            return redirect()->back()
                ->with('success','file not found') ;
    }

    public function ordercustomPhotoDownload($id)
    {
        $order_items = OrderItem::find( $id );
        $path2 = public_path( $order_items->design_file);

        if( file_exists($path2))
           { return response()->download($path2);}
        else
            return redirect()->back()
                ->with('success','file not found') ;
    }

    public function printworkeraccept( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Implementing';
        $order->printWorker_id = Auth::user()->id;
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully') ;
    }

    public function printworkerorders( $id)
    {
        $order = Order::where('printWorker_id' , $id )->where('status','Implementing')->get();
        $myordersCount = Order::where('printWorker_id' , $id)->where('status','Implementing')->count();
        return view('printworkerorders')->with('order' , $order)->with('myordersCount',$myordersCount);
    }

    public function printworkeritemsorder( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();


        $myordersCount = Order::where('printWorker_id' , $id)->where('status','Implementing')->count();

        return view('printworkeritemsorder')->with('order' , $order)->with('itemso' , $itemso)->with('myordersCount',$myordersCount);
    }


    public function printworkerdownload( $id)
    {
        $order = Order::find( $id );

        $path = public_path('uploads/designs/'.$order->file_path);
        if( file_exists($path))
        return response()->download($path);
        else
            return redirect()->back()
                ->with('success','file not found') ;
    }

    public function printworkersubmit( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Finished';
        $order->save();
        return redirect()->back()
            ->with('success','order submitted successfully') ;
    }

    public function printworkercancel( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Designed';
        $order->printworker_id = null;
        $order->save();
        return redirect()->back()
            ->with('success','order canceled successfully') ;
    }
    ////////////////////////////////////////////////// accountant /////////////////////////////////////////////////////
    public function accountantaccept( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'inbilled';
        $order->accountant_id = Auth::user()->id;
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully') ;
    }

    public function accountantorders( $id)
    {
        $order = Order::where('accountant_id' , $id )->where('status','inbilled')->get();
        $myordersCount = Order::where('accountant_id' , $id)->where('status','inbilled')->count();
        return view('accountantorders')->with('order' , $order)->with('myordersCount',$myordersCount);
    }

    public function accountantitemsorder( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();


        $myordersCount = Order::where('accountant_id' , $id)->where('status','inbilled')->count();

        return view('accountantitemsorder')->with('order' , $order)->with('itemso' , $itemso)->with('myordersCount',$myordersCount);
    }

    public function accountantdownload( $id)
    {
        $order = Order::find( $id );

        $path = public_path('uploads/designs/'.$order->file_path);
        if( file_exists($path))
        return response()->download($path);
        else
            return redirect()->back()
                ->with('success','file not found') ;
    }

    public function accountantsubmit(Request $request, $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Billed';
        $order->payment_method = $request->payment_method;
        $order->save();
        return redirect()->back()
            ->with('success','Approve Payment for order successfully') ;
    }

    public function accountantcancel( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Finished';
        $order->packager_id = null;
        $order->save();
        return redirect()->back()
            ->with('success','order canceled successfully') ;
    }
    //-------------------------------------------------------------packager------------------------------------------
    public function packageraccept( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'inPackage';
        $order->packager_id = Auth::user()->id;
        $order->save();
        return redirect()->back()
            ->with('success','order accepted successfully') ;
    }

    public function packagerorders( $id)
    {
        $order = Order::where('packager_id' , $id )->where('status','inPackage')->get();
        $myordersCount = Order::where('packager_id' , $id)->where('status','inPackage')->count();
        return view('packagerorders')->with('order' , $order)->with('myordersCount',$myordersCount);
    }

    public function packageritemsorder( $id)
    {
        $order = Order::where('id' , $id )->first();
        $itemso = OrderItem::where('order_id' , $id )->get();


        $myordersCount = Order::where('packager_id' , $id)->where('status','inPackage')->count();

        return view('packageritemsorder')->with('order' , $order)->with('itemso' , $itemso)->with('myordersCount',$myordersCount);
    }

    public function packagerdownload( $id)
    {
        $order = Order::find( $id );

        $path = public_path('uploads/designs/'.$order->file_path);
        if( file_exists($path))
        return response()->download($path);
        else
            return redirect()->back()
                ->with('success','file not found') ;
    }

    public function packagersubmit( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'packaged';
        $order->save();
        return redirect()->back()
            ->with('success','order submitted successfully') ;
    }

    public function packagercancel( $id)
    {
        $order = Order::find( $id ) ;
        $order->status = 'Billed';
        $order->packager_id = null;
        $order->save();
        return redirect()->back()
            ->with('success','order canceled successfully') ;
    }

}
