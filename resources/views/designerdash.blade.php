@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>All Orders </b> </h5>
        </div>
        <div class="row">
        <div class="container">
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
            @endif
        </div>
        </div>
        <div class="row">
            @if ($orders->count() > 0 )
                <div class="col">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 40px" scope="col">#</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Customer notes</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Date</th>

                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($orders as $item)
                            <tr>
                                <th class="text-white bg-secondary">{{$i++}}</th>
                                <td>{{$item->id}}</td>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->customer_notes}}</td>
                                <td>{{$item->user_name}}</td>
                                <td>{{$item->created_at }}</td>
                                <td>
                                    <a class="btn btn-danger" href="{{route('designeraccept',['id'=> $item->id])}}"> Accept </a>&nbsp;&nbsp;
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No Orders
                    </div>
                </div>

            @endif


        </div>
    </div>

@endsection
