@extends('layouts.app')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/invoice.css')}}">
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Order
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: {{$order->id}}
                </small>
            </h1>


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
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <span class="text-default-d3">DesignWorld</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <div class="row">
                        <div class="col-sm-6">
                             <div class="text-grey-m2">
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ $order->created_at  }}</div>
                                 <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Customer Name:</span>{{ $order->customer_name  }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Customer Notes:</span>{{ $order->customer_notes  }}</div>


                            </div>
                        </div>
                        <!-- /.col -->


                        <!-- /.col -->
                    </div>
                    @if ($itemso->count() > 0 )
                    <br class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="col-9 col-sm-5">Item</div>
                            <div class="col-9 col-sm-5">Qty</div>
                            <div class="d-none d-sm-block col-sm-2">Rate</div>
                         </div>
                        @php
                                $i = 1;
                            @endphp
                            @foreach ($itemso as $item)

                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="col-9 col-sm-5">{{ $item->item_name  }}</div>
                                <div class="col-9 col-sm-5  " >{{$item->quantity}}</div>
                                <div class="d-none d-sm-block col-2  ">{{$item->rate}}</div>
                         </div>
                         </div>
                                @endforeach
                                @else
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            No items in order
                        </div>
                    </div>

                @endif

                        <div class="row border-b-2 brc-default-l2"></div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                <div class="row my-2" >
                                    <div class="col-7 text-right">
                                        Sub total
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{$order->sub_total}}</span>
                                    </div>
                                    <div class="col-7 text-right">
                                        Discount ({{$order->discount_type}})
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{ $order->discount   }}</span>
                                    </div>
                                    <div class="col-7 text-right">
                                        Tax ({{$order->tax_type}})
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{ $order->tax   }}</span>
                                    </div>
                                </div>

                                <div class="row  align-items-center">
                                    <div class="col-7 text-right ">Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span  class="text-150 text-success-d3 opacity-2">{{$order->total }} AED</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <span class="text-120 text-success-d3">Created by: {{ $order->user_name  }}</span>
                    </br>
                        <div>
                            <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        </div>
                        </br>


                        </div>  </br></div>
                        </br>
                        <div class="row">
                        <div class="col-sm-6">
            <a class="btn btn-danger" href="{{url()->previous()}}"> Back</a>
            </div> </div>

                </div>   </div>

            </div>

        </div>

    </div>
@endsection
