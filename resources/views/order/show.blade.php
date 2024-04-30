@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item bg-light" aria-current="true"><h3><b> Order ID :</b> {{ $order->id  }} </h3></li>
            <li class="list-group-item"><b> Customer name :</b> {{ $order->customer_name  }}</li>
            <li class="list-group-item"><b> Customer notes :</b> {{ $order->customer_notes  }}</li>
            <li class="list-group-item"><b> Order Status :</b> {{ $order->status  }}</li>
            <li class="list-group-item"><b> Recipient name :</b> {{ $order->user_name  }}</li>
            <li class="list-group-item"><b> Discount :</b> {{ $order->discount  }}</li>
            <li class="list-group-item"><b> Tax :</b> {{ $order->tax  }}</li>
            <li class="list-group-item"><b> Total :</b> {{ $order->total  }}</li>
            <li class="list-group-item"><b> Date :</b> {{ $order->created_at  }}</li>
            <div class="row">
                @if ($itemso->count() > 0 )
                    <div class="col">
                        <table class="table  table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th style="width: 40px" scope="col">#</th>
                                <th scope="col">Item ID</th>
                                <th scope="col">Item_name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Rate</th>
                                <th scope="col">attached_file</th>


                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($itemso as $item)
                                <tr>
                                    <td class="text-white bg-secondary" scope="row">{{$i++}}</td>
                                    <td>
                                    <input type="text" name="item_id[]" value="{{ $item->item_id }} "
                                           class="form-control" disabled>    </td>
                                    <td>
                                        <input type="text" name="item_name[]" value="{{ $item->item_name }} "
                                               class="form-control" disabled>
                                    </td>

                                    <td>
                                        <input type="text" name="quantity[]" value="{{ $item->quantity }} "
                                               class="form-control" disabled>
                                    </td>

                                    <td>
                                        <input type="text" name="rate[]" value="{{ $item->rate }}"
                                               class="form-control" disabled>
                                    </td>

                                    <td>@if(isset($item->attached_file))
                                            <a  href="{{route('recipientDownload',['id'=> $item->id] )}}">download</a>)
                                        @else
                                            No file
                                        @endif
                                    </td>

                            @endforeach

                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="{{route('estimate',['id'=> $order->id])}}"> Create estimate</a>
                        <a class="btn btn-danger" href="{{route('orders')}}"> Back</a>
                    </div>
                @else
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            No items in order
                        </div>
                    </div>

                @endif


            </div>


        </ul>
    </div>

@endsection
