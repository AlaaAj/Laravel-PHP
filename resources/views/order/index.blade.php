@extends('layouts.app')
@section('content')

    <div class="container">


        <div class="alert alert-secondary  d-flex justify-content-between" role="alert">
            <h5><b>All Orders </b></h5>
            <a class="btn btn-primary" href="{{route('order.create')}}"> Create Order</a></td>
        </div>

        <div class="row">
            <div class="container">
                @if($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{$message}}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route("orders")}}">All</a></li>
                        <li>
                            <a class="dropdown-item" href="{{route('orders.status',['status'=> 'PendingCustomerApprovment'])}}">
                                Pending Customer Confirm
                            </a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'new'])}}">New</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'inDesign'])}}">InDesign</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Confirm'])}}">Pending Confirm Design</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Approved'])}}">Approved Design</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Designed'])}}">Designed</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Implementing'])}}">Implementing</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Finished'])}}">Finished</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Billed'])}}">Billed</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'InPackage'])}}">In Packaging</a></li>
                        <li><a class="dropdown-item" href="{{route('orders.status',['status'=> 'Packaged'])}}">Packaged</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </br>
        <div class="row">
            @if ($orders->count() > 0 )
                <div class="col">
                    <table id="myTable"
                           class="table table-bordered table-striped table-hover datatable-Chair datatable">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 40px" scope="col">#</th>

                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Designer</th>
                            <th scope="col">Print Worker</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Approve</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($orders as $item)
                            <tr>
                                <td class="text-white bg-secondary" scope="row">{{$i++}}</td>

                                <td>{{$item->id}}</td>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->status}}</td>

                                @if($item->designer_id!=null)
                                    <td>{{$item->designer->name}}</td>
                                @else
                                    <td></td>
                                @endif
                                @if($item->printWorker_id!=null)
                                    <td>{{$item->printWorker->name}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$item->total }}</td>

                                <td>{{$item->created_at }}</td>
                                <td style="text-align:center">
                                    <a class="text-success" href="{{route('order.show',['id'=> $item->id])}}"> <i
                                                class="fas  fa-eye"></i></a>
                                    <a class="text-edit" href="{{route('order.edit',['id'=> $item->id])}}"> <i
                                                class="fas fa-edit"></i></a>
                                    <a class="text-danger" href="{{route('order.destroy',['id'=> $item->id])}}"> <i
                                                class="fas fa-trash-alt"></i> </a>
                                </td>
                                <td>
                                    @if($item->status == "PendingCustomerApprovment")
                                    <a class="btn btn-primary" href="{{route('approve',['id'=> $item->id])}}"> approve</a></td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No orders
                    </div>
                </div>

            @endif


        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        console.log("test");

        $(document).ready(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 8, 'desc' ]],
                pageLength: 10,
            });
            $('#myTable').DataTable({  dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ] });
        });
    </script>
@endsection
