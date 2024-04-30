@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-secondary  " role="alert">
        <h5 > <b>Deleted Invoice </b> </h5>
    </div>
    <div class="row">


        @if ($invoices->count() > 0 )
        <div class="col">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                  <th style="width: 40px" scope="col">#</th>
                      <th scope="col">Invoice ID</th>
                      <th scope="col">Amount</th>
            <th scope="col" >Date</th>

            <th scope="col" style="width: 400px">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($invoices as $item)
                    <tr>
                        <th class="text-white bg-secondary">{{$i++}}</th>
                        <th>{{$item->id }}</th>
                        <td>{{$item->total}}</td>
                        <td class="bg-light">{{$item->created_at }}</td>
                        <td>
                            <a  class="text-success" href="{{route('invoice.restore',['id'=> $item->id])}}"> <i class="fas  fa-undo"></i></a> &nbsp;&nbsp;
                            <a class="text-danger" href="{{route('invoice.hdelete',['id'=> $item->id])}}"> <i class="fas  fa-trash-alt"></i> </a>
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
