@extends('layouts.app')

@section('content')

<div class="container" >
    <ul class="list-group">
        <li class="list-group-item bg-light" aria-current="true"><h3 ><b>  Customer ID :</b>  {{ $customer->id  }} </h3></li>
        <li class="list-group-item"><b>  Customer name:</b>  {{ $customer->name  }}</li>
        <li class="list-group-item"><b>  Customer phone:</b>  {{ $customer->phone  }}</li>
        <li class="list-group-item"><b>  Customer email:</b> {{ $customer->email  }}</li>
        <li class="list-group-item"><b>  Billing address:</b> {{ $customer->billing_address  }}</li>
        <li class="list-group-item"><b>  Shipping address:</b> {{ $customer->shipping_address  }}</li>
        <li class="list-group-item"><b>  Created At:</b> {{ $customer->created_at  }}</li>
    </ul>
    <div class="mb-3">
        <a class="btn btn-danger" href="{{route('customers')}}"> Back</a>
    </div>
</div>

@endsection
