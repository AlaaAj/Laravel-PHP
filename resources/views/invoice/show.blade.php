@extends('layouts.app')

@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/invoice.css')}}">
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: {{$invoice->id}}
                </small>
            </h1>

            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="{{route('invoice.export',['id'=> $invoice->id])}}" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
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
                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$invoice->id}}</div>
                            <div class="text-grey-m2">
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{ $invoice->created_at  }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Order ID:</span>{{ $order->id  }}</div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Customer Name:</span>{{ $invoice->customer_name  }}</div>
                            </div>
                        </div>
                        <!-- /.col -->


                        <!-- /.col -->
                    </div>

                    <br class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="col-9 col-sm-5">Item</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2" align="center">Amount</div>
                        </div>

                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="col-9 col-sm-5">{{ $order->item_name  }}</div>
                                <div class="d-none d-sm-block col-2">{{$order->quantity}}</div>
                                <div class="d-none d-sm-block col-2 text-95">{{$order->item->price}}</div>
                                <div class="col-2 text-secondary-d2" align="center">{{$invoice->amount}}</div>
                            </div>
                        </div>

                        <div class="row border-b-2 brc-default-l2"></div>

                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                <div class="row my-2" >
                                    <div class="col-7 text-right">
                                        Discount (%)
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{ $invoice->discount  }}</span>
                                    </div>
                                </div>

                                <div class="row  align-items-center">
                                    <div class="col-7 text-right ">Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span  class="text-150 text-success-d3 opacity-2">{{ $invoice->total  }} S.P.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <span class="text-120 text-success-d3">Created by: {{ $invoice->user_name  }}</span>
                    </br>
                        <div>
                            <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
