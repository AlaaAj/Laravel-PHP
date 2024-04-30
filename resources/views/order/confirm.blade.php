@extends('layouts.app')
@section('content')

<div  >


        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>Recheck Designed Orders </b> </h5>
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
            <table class="table  table-hover">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 40px" scope="col">#</th>

                    <th scope="col" >Order ID</th>
                    <th scope="col" >Customer Name</th>
                    <th scope="col" >Customer Notes</th>
                    <th scope="col">Status</th>
                    <th scope="col">Recipient</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Tax</th>
                    <th scope="col">Total</th>
                    <th scope="col">Designer</th>
                    <th scope="col">Print Worker</th>
                    <th scope="col"  >Date</th>
                    <th scope="col"   >Actions</th>
                    <th scope="col"   >Re-check</th>
                    <th scope="col"   >Accept</th>

                </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $item)
                        <tr>
                            <th class="text-white bg-secondary" scope="row">{{$i++}}</th>

                            <td>{{$item->id}}</td>
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->customer_notes}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->discount}}</td>
                            <td>{{$item->tax}}</td>
                            <td>{{$item->total}}</td>

                            @if($item->designer_id!=null)
                                <td>{{$item->designer->name}}</td>
                            @else
                                <td></td>
                            @endif
                            @if($item->printWorker_id!=null)
                                <td>{{$item->printWorker->name}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$item->created_at }}</td>
                            <td style="text-align:center">
                            <a  class="text-success" href="{{route('order.show',['id'=> $item->id])}}"> <i class="fas  fa-eye"></i></a>
                            <a  class="text-edit" href="{{route('order.editconfirm',['id'=> $item->id])}}"> <i class="fas fa-edit"></i></a>
                            <a class="text-danger" href="{{route('order.destroy',['id'=> $item->id])}}"> <i class="fas fa-trash-alt"></i> </a>
                            <td><a class="text-warning" href="{{route('order.retry',['id'=> $item->id])}}"> Retry </a></td>
                            <td><a class="text-success" href="{{route('order.finish',['id'=> $item->id])}}"> <i class="fas fa-paper-plane"></i> </a></td>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
          </div>
        @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
                No orders
              </div>
        </div>

        @endif


    </div>
</div>
  @endsection
