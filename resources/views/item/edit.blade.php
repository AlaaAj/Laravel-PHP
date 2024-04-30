@extends('layouts.app')

@section('content')

    <div class="container"   >
        <div class="alert alert-secondary ">
            <h5>Item {{ $item->id  }}: {{$item->name}}</h5>
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
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
    </div>

<div class="container">
<form action="{{ route('item.update', ['id'=> $item->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1">  Name </label>
            <input type="text" name="name" value="{{ $item->name  }} "  class="form-control"  placeholder="item name">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1">  Price   </label>
            <input type="text" name="price" value="{{ $item->price  }} "  class="form-control"  placeholder="item price">
          </div>

          <div class="mb-3">
                <label for="exampleFormControlInput1">Photo  </label>
                <input type="file"  name="photo" class="form-control" value="{{$item->photo}}">
              </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-danger" href="{{route('items')}}"> Back</a>

        </div>



    </form>
</div>

@endsection
