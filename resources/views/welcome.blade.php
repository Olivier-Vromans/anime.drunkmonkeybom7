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
                    <p class="fs-4">Bootstrap utility classes are used to create this jumbotron since the old component has been removed from the framework. Why create custom CSS when you can use utilities?</p>
                    @guest
                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Register/Login</a>
                        @endif
                    @else
                    @endguest
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
{{--    TODO DETAIL PAGE with get and ID element--}}
{{--    <ul>--}}
{{--        @foreach($animes as $anime)--}}
{{--            <li>{{$anime['title']}}</li>--}}
{{--            <img src="{{ asset("/storage/images/".$anime['image']) }}" alt="" height="300px">--}}
{{--        @endforeach--}}
{{--    </ul>--}}
            <div id="container" class="container">
                @foreach($animes as $anime)
                <div class="cards" id="cards">
                    <a href="#">
                        <div class="card" id="card">
                            <div class="image-box">
                                <img src="{{ asset("/storage/images/".$anime['image']) }}" alt="" height="300px">
                            </div>
                            <div class="content-box">
                                <h2>{{$anime['title']}}</h2>
                                <div class="detail">
                                    <span>220 ep</span>
                                    <span>Fall 2020</span>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
@endsection
