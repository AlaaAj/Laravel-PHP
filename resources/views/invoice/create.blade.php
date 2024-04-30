@extends('layouts.app')
@section('content')

<div class="container" >
    <div class="container">
        @if($message = Session::get('failed'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
    </div>
    <div class="alert alert-secondary  " role="alert">
        <h5 > <b>Create an invoice </b> </h5>
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
<form action="{{ route('invoice.store',['id'=> $order->id])}}" method="POST">
    @csrf

        <div class="mb-3">
          <label for="exampleFormControlTextarea1">Details  </label>
          <textarea class="form-control" name="detail"   rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1">  Amount </label>
            <input type="text" name="amount" class="form-control"  placeholder="bill value" value="{{$order->amount}}" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1">  Discount </label>
            <input type="text" name="discount" class="form-control"  placeholder="Discount %">
        </div>


        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>

        </div>

    </form>
</div>





@endsection
