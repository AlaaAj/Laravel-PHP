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
                <form action="{{route('user.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1">Name  </label>
                        <input id="name" type="text" name="name" class="form-control"  required autofocus >
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Username  </label>
                        <input class="form-control" id="email" name="email" required  >
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Password  </label>
                        <input class="form-control" id="password" type="password" name="password"  required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Confirm Password  </label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required >
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Role  </label>
                        <select class="form-control" name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="administrator">administrator</option>
                            <option value="recipient">recipient</option>
                            <option value="designer">designer</option>
                            <option value="printworker">printworker</option>
                            <option value="accountant">accountant</option>
                            <option value="packager">packager</option>
                        </select>
                    </div>

                    <div class="mb-3">

                        <button class="btn btn-primary" type="submit">Create</button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection







