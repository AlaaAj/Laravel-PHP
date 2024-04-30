<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('name')->get();
        return view('item.index')->with('items',$items);
    }

    public function itemsTrashed()
    {
        $items = Item::onlyTrashed()->get();
        return view('item.trashed')->with('items',$items);
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>  'required',
            'price' =>  'required',
            'photo' =>  'required|image',
        ]);

        $photo = $request->photo;
        $newPhoto = $photo->getClientOriginalName();
        $photo->move('uploads/items',$newPhoto);

        $item = Item::create([
            'name' =>  $request->name,
            'price' =>   $request->price,
            'photo' =>  'uploads/items/'.$newPhoto,
        ]);

        return redirect()->route('items')
        ->with('success','item added successflly');


    }


    public function show($id)
    {
        $item = Item::where('id' , $id )->first();
        return view('item.show')->with('item' , $item);
    }


    public function edit(  $id)
    {
        $item = Item::where('id' , $id )->first();
        if ($item === null) {
           return redirect()->back() ;
       }
       return view('item.edit')->with('item',$item);
    }

    public function update(Request $request,  $id)
    {
        $item = Item::find( $id ) ;
        $this->validate($request,[
            'name' =>  'required',
            'price' =>  'required'
        ]);

    if ($request->has('photo')) {
        $photo = $request->photo;
        $newPhoto = $photo->getClientOriginalName();
        $photo->move('uploads/items',$newPhoto);
        $item->photo ='uploads/items/'.$newPhoto ;
    }

    $item->name = $request->name;
    $item->price = $request->price;
    $item->save();
    return redirect()->back()->with('success','item updated successflly') ;

    }

    public function destroy( $id)
    {
        $item = Item::where('id' , $id )->first();
        if ($item === null) {
           return redirect()->back() ;
       }

        $item->delete($id);
        return redirect()->back()
        ->with('success','item deleted successflly') ;

    }

    public function hdelete( $id)
    {
        $item = Item::withTrashed()->where('id' ,  $id )->first() ;
        $item->forceDelete();
        return redirect()->back() ;
    }

    public function restore( $id)
    {
        $item = Item::withTrashed()->where('id' ,  $id )->first() ;
        $item->restore();
        return redirect()->back() ;
    }
}
