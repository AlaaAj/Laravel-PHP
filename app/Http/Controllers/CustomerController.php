<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'=>'required',
            'email'=>'nullable|email',
    ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'billing_address' => $request->billing_address,
            'shipping_address' => $request->shipping_address,

        ]);

        return redirect()->route('customers')
            ->with('success','Customer created successfully') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show')->with('customer',$customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {

        return view('customers.edit')->with('customer',$customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'nullable|email',
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->billing_address = $request->billing_address;
        $customer->shipping_address = $request->shipping_address;

        $customer->save();

        return redirect()->route('customers')
            ->with('success','Customer edited successfully') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()
            ->with('success','Customer deleted successfully') ;
    }

    public function customersTrashed()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('customers.trashed')->with('customers',$customers);
    }

    public function hdelete( $id)

    {
        Customer::withTrashed()->where('id' ,  $id )->forceDelete();
        return redirect()->back() ;
    }

    public function restore( $id)
    {
        Customer::withTrashed()->where('id' ,  $id )->restore();
        return redirect()->back();
    }


}
