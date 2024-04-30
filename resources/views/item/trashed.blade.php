@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-secondary  " role="alert">
        <h5 > <b>Deleted Items </b> </h5>
    </div>
    <div class="row">
        @if ($items->count() > 0 )
        <div class="col">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                  <th scope="col" style="width: 40px">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price</th>
            <th scope="col" style="width: 400px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($items  as $item)
                    <tr>
                        <th scope="row" class="text-white bg-secondary">{{$i++}}</th>
                        <th class="bg-light">{{ $item->name }}</th>
                        <td>{{ $item->price }}</td>
                        <td>
                            <a  class="text-success" href="{{route('item.restore',['id'=> $item->id])}}"> <i class="fas  fa-undo"></i></a> &nbsp;&nbsp;
                            <a class="text-danger" href="{{route('item.hdelete',['id'=> $item->id])}}"> <i class="fas   fa-trash-alt"></i> </a>
                        </td>
                      </tr>
                    @endforeach

                </tbody>
              </table>


          </div>
        @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
               Empty trash
              </div>
        </div>

        @endif


    </div>
  </div>
@endsection
