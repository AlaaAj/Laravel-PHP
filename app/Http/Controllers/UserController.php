<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
            return view('user.index')->with('users',$users);
    }

    public function create()
    {
        return view('user.createuser');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->attachRole($request->role_id);
        event(new Registered($user));

        return redirect()->route('users')
        ->with('success','User created successfully') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id' , $id )->first();
        if ($user === null) {
            return redirect()->back() ;
        }
        return view('user.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find( $id ) ;
        $this->validate($request,[
            'password' => 'required|string|confirmed|min:8'
        ]);

        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(RouteServiceProvider::HOME)
            ->with('success','Password has been reset successfully') ;
    }

    public function changeName(Request $request, $id)
    {
        $user = User::find( $id ) ;
        $this->validate($request,[
            'name' => 'required|string'
        ]);

        $user->name = $request->name;
        $user->save();
        return redirect(RouteServiceProvider::HOME)
            ->with('success','Name has been reset successfully') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $item = User::where('id' , $id )->first();
        if ($item === null) {
            return redirect()->back() ;
        }

        $item->delete($id);
        return redirect()->back()
            ->with('success','User deleted successflly') ;

    }

    public function hdelete( $id)
    {
        $item = User::withTrashed()->where('id' ,  $id )->first() ;
        $item->forceDelete();
        return redirect()->back() ;
    }

    public function restore( $id)
    {
        $item = User::withTrashed()->where('id' ,  $id )->first() ;
        $item->restore();
        return redirect()->back() ;
    }

    public function usersTrashed()
    {
        $users = User::onlyTrashed()->get();
        return view('user.trashed')->with('users',$users);
    }

    public function userReset()
    {
        $user = User::where('id' , Auth::user()->id )->first();
        if ($user === null) {
            return redirect()->back() ;
        }
        return view('user.reset')->with('user',$user);
    }


    public function userUpdate(Request $request)
    {

        $user = User::find( Auth::user()->id ) ;
        $this->validate($request,[
            'password' => 'required|string|confirmed|min:8'
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(RouteServiceProvider::HOME)
                ->with('success','Password has been reset successfully') ;
        }else{
            return redirect()->back()->with('failed','Old password is wrong') ;
        }

    }
}
