@extends('layouts.app')

@section('content')

<div class="container">
    <div class="alert alert-secondary ">

          <h3><b>   Customer ID :</b> {{ $customer->id  }} </h3>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="container">
<form action="{{ route('customer.update', ['customer'=> $customer])}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Name  </label>
        <input class="form-control" value="{{$customer->name}}"  type="text" name="name"  required >
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Email  </label>
        <input class="form-control" value="{{$customer->email}}"  type="email" name="email"   >
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Phone  </label>
        <input class="form-control" value="{{$customer->phone}} " type="phone" name="phone"   >
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Billing address  </label>
        <textarea class="form-control"   type="text" name="address"   >{{$customer->billing_address}}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Shipping address  </label>
        <textarea class="form-control"   type="text" name="address"   >{{$customer->shipping_address}}</textarea>
    </div>

    <div class="mb-3">

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{route('customers')}}" class="btn btn-danger">Cancel</a>
    </div>
    </form>
</div>

@endsection
