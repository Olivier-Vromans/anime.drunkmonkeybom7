@extends('layouts.layout')
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
    <ul>
        @foreach($animes as $anime)
            <li>{{$anime['title']}}</li>
        @endforeach
    </ul>
@endsection
