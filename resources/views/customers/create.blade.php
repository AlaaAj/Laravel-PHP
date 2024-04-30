@extends('layouts.app')
@section('content')

<div class="container"   >
    <div class="alert alert-secondary ">
        <h5>Create a new customer</h5>
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
<form action="{{ route('customer.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label for="exampleFormControlInput1">  Name</label>
            <input type="text" name="name" class="form-control"  placeholder="Name">
        </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1">  Email (optional)</label>
        <input type="email" name="email" class="form-control"  placeholder="email">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1">  Phone (optional)</label>
        <input type="number" name="phone" class="form-control"  placeholder="phone">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput1">  Billing address  </label>
        <input type="text" name="billing_address" class="form-control"  placeholder="billing address">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1">  Shipping address address  </label>
        <input type="text" name="shipping_address" class="form-control"  placeholder="shipping address">
    </div>


        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{route('customers')}}" class="btn btn-danger">Cancel</a>

        </div>
</form>
</div>





@endsection
