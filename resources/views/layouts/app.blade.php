<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <style>

        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }


        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Design World') }}</title>

    <!-- Scripts -->
    <link href={{ URL::asset('DataTables/datatables.css') }} rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #09adc8">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Design World') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::user()->hasRole('recipient'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false" e>
                                Orders
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('orders')}}">
                                    All Orders
                                </a>
                                <a class="dropdown-item" href="{{route('order.confirm')}}">
                                    Recheck Order
                                </a>
                                <a class="dropdown-item" href="{{route('order.create')}}">
                                    Create Order
                                </a>
                                <a class="dropdown-item" href="{{route('orders.trashed')}}">
                                    Deleted Orders
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Customers
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('customers')}}">
                                    All Customers
                                </a>
                                <a class="dropdown-item" href="{{route('customer.create')}}">
                                    Add Customer
                                </a>
                                <a class="dropdown-item" href="{{route('customers.trashed')}}">
                                    Deleted Customers
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Items
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('items')}}">
                                    All Items
                                </a>
                                <a class="dropdown-item" href="{{route('item.create')}}">
                                    Add Item
                                </a>
                                <a class="dropdown-item" href="{{route('items.trashed')}}">
                                    Deleted Items
                                </a>
                            </div>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('accountant'))
                    <li class="nav-item">
                            <a class="nav-link position-relative" href="{{route('accountantorders',Auth::user()->id)}}">
                                My Orders
                                @if($myordersCount >0)
                                    <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger text-light rounded-circle">
                                    {{$myordersCount}}
                                    </span>
                                @endif
                            </a>

                        </li>
                    @endif

                    @if (Auth::user()->hasRole('packager'))
                    <li class="nav-item">
                            <a class="nav-link position-relative" href="{{route('packagerorders',Auth::user()->id)}}">
                                My Orders
                                @if($myordersCount >0)
                                    <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger text-light rounded-circle">
                                    {{$myordersCount}}
                                    </span>
                                @endif
                            </a>

                        </li>
                    @endif

                    @if (Auth::user()->hasRole('administrator'))
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{route('orders')}}"> Orders
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Users
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('users')}}">
                                    All Users
                                </a>
                                <a class="dropdown-item" href="{{route('createuser')}}">
                                    Add User
                                </a>
                                <a class="dropdown-item" href="{{route('users.trashed')}}">
                                    Deleted Users
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Customers
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('customers')}}">
                                    All Customers
                                </a>
                                <a class="dropdown-item" href="{{route('customer.create')}}">
                                    Add Customer
                                </a>
                                <a class="dropdown-item" href="{{route('customers.trashed')}}">
                                    Deleted Customers
                                </a>
                            </div>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('designer'))
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{route('designerorders',Auth::user()->id)}}">
                                My Orders
                                @if($myordersCount >0)
                                    <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger text-light rounded-circle">
                                    {{$myordersCount}}
                                    </span>
                                @endif
                            </a>

                        </li>
                    @endif
                    @if (Auth::user()->hasRole('printworker'))
                        <li class="nav-item">
                            <a class="nav-link position-relative"
                               href="{{route('printworkerorders',Auth::user()->id)}}"> My Orders
                                @if($myordersCount >0)
                                    <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger text-light rounded-circle">
                                    {{$myordersCount}}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto ">

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('user.reset')}}">
                                Reset Password
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src={{ URL::asset('DataTables/datatables.js') }}></script>
@yield('scripts')
</body>
</html>



