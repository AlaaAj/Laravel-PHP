@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>All Users</b> </h5>
        </div>
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
        <div class="container">

        </div>
        <div class="row">
            @if ($users->count() > 0 )
                <div class="col">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 40px" scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th class="text-white bg-secondary">{{$user->id }}</th>
                                <th class="bg-light">{{$user->name}}</th>
                                <td>@foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach</td>
                                <td>{{$user->created_at}}</td>
                                <td >
                                    <a class="text-edit" href="{{route('user.edit',['id'=> $user->id])}}"> <i class="fas fa-edit"></i></a>
                                    @if($user->id != Auth::user()->id)
                                        <a class="text-danger" href="{{route('user.destroy',['id'=> $user->id])}}"> <i  class="fas  fa-trash-alt"></i> </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        Not billed orders
                    </div>
                </div>

            @endif


        </div>
    </div>

@endsection
