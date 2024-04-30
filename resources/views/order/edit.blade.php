@extends('layouts.app')

@section('content')

<div class="container">
<form action="{{ route('order.update', ['id'=> $order->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="alert alert-secondary ">
    <table>
  <tr>
    <th bgcolor="LightGray"> <h1><b>   Order ID :</b> {{ $order->id  }} </h1></th>
    <th> <div class="mb-3">
            <label for="exampleFormControlInput1"><h4> Order Status</h4></label>
            <select class="form-control" name="status">
               <option value="New" selected>New Item</option>
               <option value="In designed" >In designed</option>
               <option value="Designed" >Designed</option>
               <option value="In implementation" >In implementation</option>
               <option value="Implemented" >Implemented</option>
               <option value="Billed" >Billed</option>
               <option value="In package" >In package</option>
               <option value="Packaged" >Packaged</option>
            </select>
        </div></th>

  </tr>
  <tr>
    <td><div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Customer name </h4> </label>
        <input type="text" name="customer" value="{{ $order->customer_name  }} "  class="form-control"  >
    </div></td>
    <td> <div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Customer notes </h4> </label>
        <input type="text" name="customer_notes" value="{{ $order->customer_notes  }} "  class="form-control"  >
    </div></td>

  </tr>
  <tr>
    <td><div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Designer </h4> </label>
                @if($order->designer_id!=null)
           <label  class="form-control" > {{$order->designer->name}} </label>
                  @else
           <label  class="form-control" >  </label>
                 @endif
    </div></td>
    <td><div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Print Worker </h4> </label>
                @if($order->printWorker_id!=null)
           <label  class="form-control" > {{$order->printWorker->name}} </label>
                  @else
           <label  class="form-control" >  </label>
                 @endif
    </div></td>

  </tr>
  <tr>
    <td> <div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Discount </h4> </label>
        <input type="text" name="discount" value="{{ $order->discount  }} "  class="form-control"  >
    </div></td>
    <td> <div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Tax </h4> </label>
        <input type="text" name="tax" value="{{ $order->tax  }} "  class="form-control"  >
    </div></td>

  </tr>
  <tr>
    <td><div class="mb-3">
        <label for="exampleFormControlInput1"> <h4> Total </h4> </label>
        <input type="text" name="total" value="{{ $order->total  }} "  class="form-control"  >
    </div></td>
    <td></td>

  </tr>


</table>




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
                    <th scope="col">Update an attached file</th>


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
                            <input type="text" name="itemoid[]" value="{{ $item->id }} "  class="form-control"   >    </td>
                            <td>
                            <input type="text" name="item_id[]" value="{{ $item->item_id }} "  class="form-control"  disabled>    </td>
                            <td>
                            <input type="text" name="order_id[]" value="{{ $item->order_id }} "  class="form-control"  disabled>    </td>

                            <td>
                            <input type="text" name="item_name[]" value="{{ $item->item_name }} "  class="form-control"  >
                            </td>

                            <td>
                            <input type="text" name="quantity[]" value="{{ intval($item->quantity) }} "  class="form-control"  >
                            </td>

                            <td>
                            <input type="text" name="rate[]"  value="{{ $item->rate }}"   class="form-control"  >
                            </td>

                            <td>
                              <input
                                        type="file"
                                        name="itemFile[]"
                                        id="itemFile[]"

                                        class="form-control @error('files') is-invalid @enderror">
                             </td>

                        </tr>
                    @endforeach

                </tbody>
              </table>
          </div>
        @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
                No items in order
              </div>
        </div>

        @endif


    </div>

    <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-danger" href="{{route('orders')}}"> Back</a>
        </div>
    </form>
</div>

@endsection




