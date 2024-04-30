@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
      <div class="col">
          <div class="alert alert-secondary  " role="alert">
              <h5 > <b>Create a new item </b> </h5>
          </div>
      </div>

    </div>
    <div class="row">

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{$item}}
                </li>
            @endforeach
        </ul>
        @endif


      <div class="col">
      <form action="{{route('item.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
              <label for="exampleFormControlInput1">Item name  </label>
              <input type="text" name="name" class="form-control"   >
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1">Item price  </label>
              <textarea class="form-control"  name="price"   rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1">Photo  </label>
                <input type="file"  name="photo" class="form-control"   >
              </div>

            <div class="mb-3">

                <button class="btn btn-primary" type="submit">save</button>
                <a class="btn btn-danger" href="{{route('dashboard')}}">Cancel</a>
            </div>

          </form>
      </div>
    </div>
  </div>
@endsection


