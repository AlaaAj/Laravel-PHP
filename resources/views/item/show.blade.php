@extends('layouts.app')

@section('content')

<div class="container">
    <ul class="list-group">
        <li class="list-group-item bg-light" aria-current="true"><h5 ><b> Item ID :</b>  {{ $item->id  }} </h5></li>
        <li class="list-group-item"><b>    Item name :</b>  {{ $item->name  }}</li>
        <li class="list-group-item"><b>  Item price :</b> {{ $item->price  }}</li>
    </ul>

</div>
<div class="container" style="padding-top: 3%;">
    <img src="{{URL::asset($item->photo )}}" class="rounded mx-auto d-block" style="height: 300px;width: 300px">
</div>
@endsection
