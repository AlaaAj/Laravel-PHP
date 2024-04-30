@extends('layouts.app')

@section('content')

<div class="container" >
<div class="row">
        <div class="container">
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
            @endif
        </div>
        </div>
<form action="{{ route('designersubmit', ['id'=> $order->id])}}" method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf
    <ul class="list-group">
        <li class="list-group-item bg-light" aria-current="true"><h3 ><b>  Order ID :</b>  {{ $order->id  }} </h3></li>
        <li class="list-group-item"><b>  Customer name :</b>  {{ $order->customer_name  }}</li>
        <li class="list-group-item"><b>  Order Status :</b>  {{ $order->status  }}</li>
        <li class="list-group-item"><b>  Recipient name  :</b>  {{ $order->user_name  }}</li>
        <li class="list-group-item"><b> Date  :</b>  {{ $order->created_at  }}</li>

        <div class="row">
        @if ($itemso->count() > 0 )
        <div class="col">

            <table class="table  table-hover">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 40px" scope="col">#</th>

                    <th scope="col" >ID</th>
                    <th scope="col" >Item ID</th>
                    <th scope="col" >Order ID</th>
                    <th scope="col">Item_name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Attached File</th>
                    <th scope="col">Design File</th>
                    <th scope="col">Upload Design</th>


                </tr>
                </thead>

                <tbody>


                    @php
                        $i = 1;
                    @endphp
                    @foreach ($itemso as $item)
                        <tr>
                            <th class="text-white bg-secondary" scope="row">{{$i++}}</th>

                            <td>
                            <input type="text" name="itemoid[]" value="{{ $item->id }} "  class="form-control"    >    </td>
                            <td>
                            <input type="text" name="item_id[]" value="{{ $item->item_id }} "  class="form-control"  disabled>    </td>
                            <td>
                            <input type="text" name="order_id[]" value="{{ $item->order_id }} "  class="form-control"  disabled>    </td>

                            <td>

                            <input type="text" name="item_name[]" value="{{ $item->item_name }} "  class="form-control"  >
                            </td>

                            <td>
                            <input type="text" name="quantity[]" value="{{ intval($item->quantity) }} "  class="form-control" disabled >
                            </td>

                            <td>
                            <input type="text" name="rate[]"  value="{{ $item->rate }}"   class="form-control" disabled >
                            </td>
                            <td>@if(isset($item->attached_file))
                                    <a  href="{{route('designerDownload',['id'=> $item->id])}}">download</a>)
                                @else
                                    No file
                                @endif
                            </td>
                            <td>@if(isset($item->attached_file))
                                    <a  href="{{route('designerDownload1',['id'=> $item->id])}}">download</a>)
                                @else
                                    No file
                                @endif
                            </td>

                            <td width='300'>
                                <input
                                        type="file"
                                        name="itemFile[]"
                                        id="itemFile[]"
                                        required
                                        class="form-control @error('files') is-invalid @enderror">   </td>


                        </tr>
                    @endforeach

                </tbody>
                <tr>


               </table>
               @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
                No items in order
              </div>
        </div>

        @endif

                <button class="btn btn-success" type="submit">Check with Customer</button>
                <a class="btn btn-warning" href="{{route('designerend',['id'=> $order->id])}}">Ready</a>
                <a class="btn btn-danger" href="{{route('designercancel',['id'=> $order->id])}}">Cancel</a>&nbsp;&nbsp;

                </tr>
          </div>


    </div>



    </ul>
    </form>

</div>

@endsection
