<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
   {
       if(Auth::user()->hasRole('administrator')){
           return redirect()->route('graphs');
       }elseif(Auth::user()->hasRole('recipient')){
        return redirect('items');
       }elseif(Auth::user()->hasRole('designer')){
           $orders = Order::where('status' , 'New' )->get();
           $myordersCount = Order::where('designer_id' , Auth::user()->id)->where('status','inDesign')->count();
           return view('designerdash')->with('orders',$orders)->with('myordersCount',$myordersCount);
       }elseif(Auth::user()->hasRole('printworker')){
           $orders = Order::where('status' , 'Designed' )->get();
           $myordersCount = Order::where('printWorker_id' , Auth::user()->id)->where('status','Implementing')->count();
        return view('printworkerdash')->with('orders',$orders)->with('myordersCount',$myordersCount);
       }elseif(Auth::user()->hasRole('packager')){
        $orders = Order::where('status' , 'Billed' )->get();
        $myordersCount = Order::where('packager_id' , Auth::user()->id)->where('status','inPackage')->count();
        return view('packagerdash')->with('orders',$orders)->with('myordersCount',$myordersCount);
       }elseif(Auth::user()->hasRole('accountant')){
           $orders = Order::where('status' , 'Finished' )->get();
           $myordersCount = Order::where('accountant_id' , Auth::user()->id)->where('status','inbilled')->count();
        return view('accountantdash')->with('orders',$orders)->with('myordersCount',$myordersCount);
       }
    }

  //  public function myprofile()
  // {
  //  return view('myprofile');
  // }

}
