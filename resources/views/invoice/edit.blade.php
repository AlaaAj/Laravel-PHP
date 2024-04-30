@extends('layouts.app')

@section('content')

        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>Edit invoice </b> </h5>
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


<div class="container" style="padding-top: 2%">
<form action="{{ route('invoice.update', ['id'=> $invoice->id])}}" method="POST" enctype="multipart/form-data">
    @csrf


        <div class="mb-3">
            <label for="exampleFormControlInput1"> Amount </label>
            <input type="text" name="amount" value="{{ $invoice->amount  }} "  class="form-control"  placeholder="bill value">
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1"> Discount </label>
            <input type="text" name="discount" value="{{ $invoice->discount  }} "  class="form-control"  placeholder="bill value">
          </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1">Details  </label>
        <textarea class="form-control" name="detail"  value="{{$invoice->detail}}"    rows="3">{!! $invoice->detail  !!}
          </textarea>
    </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>

        </div>



    </form>
</div>





@endsection
