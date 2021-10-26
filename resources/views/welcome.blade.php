@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="css/home.css">
@endsection
@section('header')
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">Welcome to your Anime List!</h1>
                    <p class="fs-4">This is a website to keep track of your favorite animes.</p>
                    @guest
                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Register</a>
                        @endif
                    @else
                    @endguest
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div>
        <h1 class="text-white text-center">Suggetions</h1>
        <div id="container" class="container">
            @foreach($animes as $anime)
                @if($anime->status === 1)
                    <div class="cards" id="cards">
                        <a href="{{ route('anime.show', $anime) }}" class="text-decoration-none">
                            <div class="card" id="card">
                                <div class="image-box">
                                    <img src="{{ asset("/storage/images/image_card/".$anime->image_card) }}" alt="" height="300px">
                                </div>
                                <div class="content-box">
                                    <h2>{{$anime->title}}</h2>
                                    <div class="detail">
                                        <span>{{$anime->episodes}} episodes</span>
                                    @if(strlen($anime->title) < 36)
                                        <span>{{$anime->year}}</span>
                                        @endif
                                        @if(strlen($anime->title) <= 18)
                                            <span>
                                                @foreach($anime->genres as $genre)
                                                        {{$genre->genre_name }}
                                                @endforeach
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('footer')
    <script>
        document.getElementById("favoriteURL").onclick = function() {
            document.getElementById("favorite").submit();
        }
    </script>
@endsection
