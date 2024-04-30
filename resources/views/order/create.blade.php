@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="alert alert-secondary ">
            <h5>Create new Order </h5>
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
    </div>
    <div class="container">
        <div class="container">
            <form action="{{ route('order.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1">Customer</label>
                    <input type="search" list="customers" id="customer" name="customerName" class="form-control"
                           placeholder="Enter customer name" required>
                    <datalist id="customers">
                        @foreach($customers as $customer)
                            <option value="{{$customer->name}}">{{$customer->name}}</option>
                        @endforeach
                    </datalist>
                    <a href="{{route('customer.create')}}" onclick="window.open('{{route('customer.create')}}',
                'newwindow',
                'width=500,height=545');
                return false;">Create new customer</a>
                </div>


                <div class="mb-3">
                    <div class="mb-3" id="itemsTable">
                        <div class="row mb-3" id="row">
                            <div class="col-3">
                                <textarea rows="3" name="itemName[]" class="form-control item" placeholder="Item"
                                          required></textarea>
                            </div>

                            <div class="col-2">
                                <input type="number" id="itemQuantity[]" name="itemQuantity[]" class="form-control quantities"
                                       placeholder="quantity" value="1" required oninput="totalSumPrices()">
                            </div>
                            <div class="col-2">
                                <input type="number" id="itemRate[]" name="itemRate[]" class="form-control rates"
                                       placeholder="Rate" required oninput="totalSumPrices()">
                            </div>

                            <div class="col-3">
                                <input
                                        type="file"
                                        name="itemFile[]"
                                        id="itemFile[]"

                                        class="form-control @error('files') is-invalid @enderror">

                                @error('files')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">

                        <a class="text-edit" onclick="addItem();">
                            <i class="fas fa-plus-circle fa-2x"></i>
                        </a>
                        <a class="text-danger" onclick="deleteItem();">
                            <i class="fas fa-minus-circle fa-2x"></i>
                        </a>
                    </div>
                    <div class="mb-3">
                        <div class="row mb-3" id="row">
                            <div class="col-1">
                                <label for="exampleFormControlInput1">Sub total</label></div>
                            <div class="col-2">
                                <input type="text" id="subtotal" name="subtotal" value="0" class="form-control" readonly>

                            </div>
                        </div>
                        <div class="row mb-3" id="row">
                            <div class="col-1">
                                <label for="exampleFormControlInput1">Discount</label></div>
                            <div class="col-2">
                                <input type="number" id="discount" name="discount" class="form-control"
                                       placeholder="0.00" value="0" oninput="totalSumPrices()">
                            </div>
                            <div class="col-1">
                                <select class="form-control" id='discountType' name='discountType' oninput="totalSumPrices()">
                                    <option value='%'>%</option>
                                    <option value='AED'>AED</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row mb-3" id="row">
                            <div class="col-1">
                                <label for="exampleFormControlInput1">Tax</label>
                            </div>
                            <div class="col-2">
                                <input type="number" id="tax" name="tax" class="form-control" placeholder="0.00" value="0" oninput="totalSumPrices()"></div>
                            <div class="col-1">
                                <select class="form-control" id='taxType' name='taxType' oninput="totalSumPrices()">
                                    <option value='%'>%</option>
                                    <option value='AED'>AED</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row mb-3" id="row">
                            <div class="col-1">
                                <label for="exampleFormControlInput1">Total</label></div>
                            <div class="col-2">
                                <input type="text" id="total" name="total" value="0"  class="form-control" readonly>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1">Customer Notes</label>
                            <textarea rows="3" id = "notes" name="notes" class="form-control item" placeholder="notes"
                                      required></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{route('orders')}}" class="btn btn-danger">Cancel</a>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script>

        var items = 0;

        function addItem() {
            var itemsTable = document.getElementById("itemsTable");

            var row = '<div class="row mb-3"  id="row">\n' +
                '                        <div class="col-3">\n' +
                '                            <textarea rows="3" type="text"  name="itemName[]" class="form-control item" placeholder="Item" required></textarea>\n' +
                '                        </div>\n' +
                '                        <div class="col-2">' +
                '                            <input type="number" id="itemQuantity[]" name="itemQuantity[]" class="form-control quantities"\n' +
                '                                       placeholder="quantity" value="1" required oninput="totalSumPrices()">' +
                '                        </div>' +
                '                        <div class="col-2">' +
                '                            <input type="number" id="itemRate[]" name="itemRate[]" class="form-control rates"\n' +
                '                                       placeholder="Rate" required oninput="totalSumPrices()">' +
                '                        </div>' +
                '                        <div class="col-3">' +
                '                         <input type="file" id="itemFile[]" name="itemFile[]" class="form-control" placeholder="itemfiles" >' +
                '                        </div>' +
                '                    </div>';


            itemsTable.insertAdjacentHTML('beforeend', row);

            var path = "{{ url('/order/action2') }}";
            var itemPrice = document.getElementById("itemPrice[]");


            $('textarea.item').typeahead({
                source: function (query, process) {

                    return $.get(path, {query: query}, function (data) {

                        return process(data);

                    });

                },
                afterSelect: function (data) {
                    // itemRetrievedPrice = data.price;
                }


            });

        }

        function deleteItem() {
            var itemsTable = document.getElementById("itemsTable");
            itemsTable.removeChild(itemsTable.lastChild);
        }


    </script>

    <script>
        var path = "{{ url('/order/action2') }}";

        // console.log(itemPrice);
        var item;
        $('textarea.item').typeahead({

            source: function (query, process) {

                return $.get(path, {query: query}, function (data) {
                    return process(data);

                });
            },
            afterSelect: function (data) {
                // itemRetrievedPrice = data.price;
                // console.log(data);
            }
        });

        function totalSumPrices(){
            var sum = 0;
            var rates = document.getElementsByClassName("rates");
            var quantities = document.getElementsByClassName("quantities");
            for (let i = 0; i < rates.length; i++)
            {
                sum += rates[i].value * quantities[i].value;
            }
            var subtotal = document.getElementById("subtotal");
            subtotal.value = sum;
            var discount = document.getElementById("discount").value;
            var discountType = document.getElementById("discountType");
            if(discountType.value == '%')
                discount = sum * (discount/100);
            sum -= discount;
            var tax = document.getElementById("tax").value;
            var taxType= document.getElementById("taxType");
            if(taxType.value == '%')
                tax = sum * (tax/100);
            sum += tax;
            var total = document.getElementById("total");
            total.value = sum;
        }
    </script>

@endsection
