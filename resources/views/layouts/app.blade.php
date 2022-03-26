<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="{{ asset('css/user/user.css') }}">

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('superadmintheme/img/favicon.png') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="padding:15px;">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}"
                style="font-family: 'Raleway', sans-serif;
                font-size: 24px;
                font-weight: 700;
                color: #333;
                text-transform: uppercase;">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <a href="{{ url('/') }}" class="logo mr-auto">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid" style="max-height: 60px;">
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    @if(Auth::User())
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::User()->name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    <i class="fa fa-user"></i>
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-key"></i>
                                    {{ __('Change Password') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-arrow-circle-o-left"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @auth
        @if(Auth::User()->role == 'student')
            <script src="{{ asset('js/student.js') }}" defer></script>
        @else
            <script src="{{ asset('js/teacher.js') }}" defer></script>
        @endif
    @endauth
</body>
</html>
