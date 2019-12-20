<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap.css') }}" />

      <style type="text/css">
        .top-row { margin-top:10px; }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    TokoKu
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- Dropdown -->
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                                Login
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('owner.login') }}">Owner</a>
                                <a class="dropdown-item" href="{{ route('admin.login') }}">Admin</a>
                                <a class="dropdown-item" href="{{ route('staff.login') }}">Staff</a>
                              </div>
                            </li>
                             <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                                Register
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('owner.register') }}">Owner</a>
                                <a class="dropdown-item" href="{{ route('admin.register') }}">Admin</a>
                                <a class="dropdown-item" href="{{ route('staff.register') }}">Staff</a>
                              </div>
                            </li>
                                        
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>              
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route($guestt.'.logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

       <main class="py-4">
            @yield('content')


        </main>

</body>


</html>
