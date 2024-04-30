@extends('layouts.app')
@section('content')

<div class="container">

    <div class="alert alert-secondary  " role="alert">
            <h5 > <b>All invoices </b> </h5>
            </div>
    <div class="row">
        @if ($invoices->count() > 0 )
        <div class="col">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" style="width: 40px">#</th>
                    <th scope="col">Invoice ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Detail</th>
                    <th scope="col" style="text-align:center">Actions</th>
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
                            <td class="bg-light">{{$item->total}}</td>
                            <td>{{$item->created_at }}</td>
                            <td>{{$item->detail}}</td>
                            <td style="text-align:center">
                                <a  class="text-success" href="{{route('invoice.show',['id'=> $item->id])}}"> <i class="fas  fa-eye"></i></a> &nbsp;&nbsp;
                                <a  href="{{route('invoice.edit',['id'=> $item->id])}}"> <i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                <a class="text-danger" href="{{route('invoice.destroy',['id'=> $item->id])}}"> <i class="fas   fa-trash-alt"></i> </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>


          </div>
        @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
                Not invoices
              </div>
        </div>

        @endif


    </div>
</div>

  @endsection
