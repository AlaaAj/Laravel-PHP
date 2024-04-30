@extends('layouts.app')
@section('content')

<div class="container">
    <div class="search-wrapper" style="border: 1px solid #ccc; border-radius: 30px; height: 50px;
    display: flex; align-items: center; width: 100%; overflow-x: hidden">
        <i class="fas fa-search" style="display: inline-block; padding: 0rem 1rem"></i>
    <div class="input-filter" style="width: 100%;">
        <input type="text" id="myInput" class="filter" onkeyup="myFunction()" placeholder="Filter" style="
/* Do not repeat the icon image */
  width: 100%; /* Full-width */
  height: 100%;
  font-size: 16px; /* Increase font-size */
  padding: .5rem; /* Add some padding */
  border: none; /* Add a grey border */
  outline: none;
   /* Add some space below the input */">
    </div>
    </div>
</div>
<div class="container">


        @if ($items->count() > 0 )
                    <div id="card-lists" Style="margin: auto;padding: 10px; display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr))" >
                    @foreach($items as $item)

                        <div class="card" style="border-radius: 10px; margin: 5px ; width: 15rem; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                            padding: 16px;
                            text-align: center;
                            background-color: #f1f1f1;">
                            <a href="{{route('order.create',['id'=>$item->id])}}">
                            <img src="{{URL::asset($item->photo )}}" class="card-img-top" style="height: 200px;width: 200px">
                            </a>
                            <div class="card-body">
                                <a href="{{route('order.create',['id'=>$item->id])}}">
                                <h5 class="card-title">{{$item->name }}</h5>
                                </a>
                                <p class="card-text">{{$item->price}} S.P.</p>
                                <a class="text-success" href="{{route('item.show',['id'=> $item->id])}}" ><i class="fas   fa-eye"></i></a>
                                <a class="text-edit" href="{{route('item.edit',['id'=> $item->id])}}" ><i class="fas  fa-edit"></i></a>
                                <a class="text-danger" href="{{route('item.destroy',['id'=> $item->id])}}"><i class="fas   fa-trash-alt"></i></a>
                            </div>

                        </div>

                    @endforeach
                    </div>
    @else
        <div class="col">
            <div class="alert alert-danger" role="alert">
                No items
              </div>
        </div>

        @endif



</div>
<script>
    function myFunction() {

        const input = document.getElementById('myInput').value.toUpperCase();
        const cards = document.getElementsByClassName('card');
        for (let i = 0; i < cards.length; i++) {
            let title = cards[i].querySelector(".card-body h5.card-title");
            if(title.innerText.toUpperCase().indexOf(input) > -1){
                cards[i].style.display = "";
            }else{
                cards[i].style.display = "none";
            }

        }
    }
</script>
  @endsection
