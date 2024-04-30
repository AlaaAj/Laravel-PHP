<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Design World') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<main class="py-4">

<div class="container">

    @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $item)
                    {{$item}}
            @endforeach
            </div>
    @endif
    @if($message = Session::get('failed'))
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
    @endif


        <div class="row">
            <div class="col">
                <form action="{{route('user.userUpdate')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Old Password  </label>
                        <input class="form-control" id="old_password" type="password" name="old_password"  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">New Password  </label>
                        <input class="form-control" id="password" type="password" name="password"  required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Confirm New Password  </label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required >

                    </div>

                    <div class="form-group">

                        <button class="btn btn-primary" type="submit">Reset</button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


</main>
</div>
</body>
</html>





