@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="alert alert-secondary  " role="alert">
            <h5 > <b>Deleted customers </b> </h5>
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
            @if ($customers->count() > 0 )
                <div class="col">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 40px">#</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Created at</th>
                            <th scope="col" style="text-align:center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <th class="text-white bg-secondary">{{$i++}}</th>
                                <th>{{$customer->id }}</th>
                                <td class="bg-light">{{$customer->name}}</td>
                                <td>{{$customer->email }}</td>
                                <td>{{$customer->phone }}
                                <td>{{$customer->address }}</td>
                                <td>{{$customer->created_at }}</td>
                                <td style="text-align:center">
                                    <a  class="text-success" href="{{route('customer.restore',['id'=> $customer->id])}}"> <i class="fas fa-undo"></i></a> &nbsp;&nbsp;
                                    <a class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas   fa-trash-alt"></i> </a>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">'
                                                <form action="{{route('customer.hdelete',['id'=> $customer->id])}}" method="POST">
                                                    @CSRF
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this customer?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No Customers
                    </div>
                </div>

            @endif


        </div>
    </div>

@endsection
