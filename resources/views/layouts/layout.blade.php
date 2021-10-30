@php
    /**
    * @var Anime $anime
    * @var Genre $genre
    * @var User $user
    *
    **/use App\Models\Genre;use App\Models\Anime;use App\Models\User;
@endphp
<!doctype html>
<html lang="en">
<head>
{{--    @dd($user)--}}
    @yield('head')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/587a279f36.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href=" {{ url('/css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- javascritp -->

    <title>Anime List</title>
    <link rel="icon" href="{{ url('/storage/images/logo1.png') }}">
</head>
<body class="bg-dark">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
{{--        Logo--}}
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ url('/storage/images/logo1.png') }}" height="90px" alt="logo"/>
        </a>
{{--        Title--}}
        <div class="nav-text">
            @guest
                @if (Route::has('register'))
                    <h4 class="text-light">Anime List</h4>
                @endif
                @else
                <h4 class="text-light">{{ Auth::user()->username }}'s Anime List</h4>
            @endguest
        </div>
{{--        navbar-toggle--}}
        <div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
{{--        navbar--}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link text-right" href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('anime') ? 'active' : '' }}">
                    <a class="nav-link text-right" href="{{ url('anime') }}">Anime</a>
                </li>
                @guest
{{--                    Check if logged in else login tab--}}
                    @if (Route::has('login'))
                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                            <a class="nav-link text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
{{--                    Check if Logged in else Register tab--}}
                    @if (Route::has('register'))
                        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                            <a class="nav-link text-right " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->role === 1)
                        <li class="nav-item {{ Request::is('anime/admin') ? 'active' : '' }}">
                            <a class="nav-link text-right" href="{{ route('admin') }}">Admin</a>
                        </li>
                    @endif
{{--                    Check if user logged in and than show profile and logout tab--}}
                    <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                        <a class="nav-link text-right" href="{{ route('user.show', $user) }}">{{ Auth::user()->username }}</a>
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
        <footer class="bg-dark text-center text-white">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/olivier.vromans/" role="button"
                    ><i class="fab fa-facebook-f"></i
                        ></a>

                    <!-- Twitter -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/Olivier2001" role="button"
                    ><i class="fab fa-twitter"></i
                        ></a>

                    <!-- Linkedin -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/olivier-vromans-57908417a/" role="button"
                    ><i class="fab fa-linkedin-in"></i
                        ></a>


                    <!-- Instagram -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/olivier_vromans/" role="button"
                    ><i class="fab fa-instagram"></i
                        ></a>

                    <!-- Twitch -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.twitch.tv/drunkmonkeybom7" role="button"
                    ><i class="fab fa-twitch"></i
                        ></a>

                    <!-- Github -->
                    <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://github.com/Olivier-Vromans" role="button"
                    ><i class="fab fa-github"></i
                        ></a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
