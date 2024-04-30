@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="row">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>
                            {{$item}}
                        </li>
                    @endforeach
                </ul>
            @endif
                <div class="col">
                <form action="{{route('user.changeName', ['id'=> $user->id])}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1">Name  </label>
                        <input id="name" type="text" name="name" class="form-control" value="{{$user->name}}" required autofocus >
                    </div>

                    <div class="mb-3">

                        <button class="btn btn-primary" type="submit">Change</button>
                    </div>
                </form>
                </div>
        </div>
        <div class="row">

            <div class="col">
                <form action="{{route('user.update', ['id'=> $user->id])}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Password  </label>
                        <input class="form-control" id="password" type="password" name="password"  required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Confirm Password  </label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required >
                    </div>

                    <div class="mb-3">

                        <button class="btn btn-primary" type="submit">Reset</button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection







