@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-secondary  " role="alert">
        <h5 > <b>Deleted Orders </b> </h5>
    </div>
    <div class="row">
        <div class="container">

        @if ($orders->count() > 0 )
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                  <th scope="col" style="width: 40px">#</th>
                      <th scope="col" >Item name</th>
                      <th scope="col" >Order ID</th>
                      <th scope="col" >Customer name</th>
                      <th scope="col">Status</th>
                      <th scope="col">Attached Photo</th>
            <th scope="col">Date</th>
            <th scope="col" style="width: 400px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $item)
                    <tr>
                        <th class="text-white bg-secondary" scope="row">{{$i++}}</th>
                        <th class="bg-light">{{$item->item_name}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->customer_name}}</td>
                        <td>{{$item->status}}</td>
                        <td><a  href="{{route('recipientDownload',['id'=> $item->id])}}">{{$item->attached_photo}}</a></td>
                        <td>{{$item->created_at }}</td>
                        <td>
                            <a  class="text-success" href="{{route('order.restore',['id'=> $item->id])}}"> <i class="fas fa-undo"></i></a> &nbsp;&nbsp;
                            <a class="text-danger" href="{{route('order.hdelete',['id'=> $item->id])}}"> <i class="fas  fa-trash-alt"></i> </a>
                        </td>
                      </tr>
                    @endforeach

                </tbody>
              </table>


        @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
               Empty trash
              </div>
        </div>

        @endif
        </div>

    </div>
  </div>
@endsection
