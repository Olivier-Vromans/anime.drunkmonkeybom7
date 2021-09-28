<!doctype html>
<html lang="en">
<head>
    @yield('head')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/587a279f36.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Anime List</title>
</head>
<body class="bg-dark">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <!--Logo-->
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="images/logo1.png" height="90px" alt="logo"/>
        </a>

        @guest
            @if (Route::has('register'))
                <h4 class="text-light">Anime List</h4>
            @endif
            @else
            <h4 class="text-light">{{ Auth::user()->username }}'s Anime List</h4>
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link text-right" href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('series') ? 'active' : '' }}">
                    <a class="nav-link text-right" href="{{ url('series') }}">Series</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a class="nav-link text-right" href="{{ url('about') }}">About</a>
                </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                            <a class="nav-link text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                            <a class="nav-link text-right " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                        <a class="nav-link text-right" href="{{ url('profile') }}">{{ Auth::user()->username }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-right" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
            <form class="form-inline my-2 my-lg-0 justify-content-end">
                <div class="search">
                    <input type="text" placeholder="Search for Anime">
                </div>
                <button class="btn btn-dark" style="outline: none" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>
    <div>
        @yield('header')
    </div>
    <div>
        @yield('content')
    </div>
    <div>
        @yield('footer')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
