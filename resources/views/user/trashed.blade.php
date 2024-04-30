@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>Deleted Users </b> </h5>
        </div>
        <div class="row">


            @if ($users->count() > 0 )
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 40px" scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Deleted At</th>
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
                                <td>{{$user->deleted_at}}</td>
                                <td style="text-align:left">
                                    <a  class="text-success" href="{{route('user.restore',['id'=> $user->id])}}"><i class="fas  fa-undo"></i></a>
                                    <a class="text-danger" href="{{route('user.hdelete',['id'=> $user->id])}}"> <i class="fas   fa-trash-alt"></i> </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        Empty trash
                    </div>
                </div>

            @endif


        </div>
    </div>
@endsection
