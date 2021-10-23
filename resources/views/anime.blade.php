@php
    /**
    * @var Anime $anime
    * @var User $user
    **/use App\Models\Anime;use App\Models\User;
@endphp
@extends('layouts.layout')
<!--Navigation-->
@section('head')
    <link rel="stylesheet" href="css/home.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js" integrity="sha512-Atu8sttM7mNNMon28+GHxLdz4Xo2APm1WVHwiLW9gW4bmHpHc/E2IbXrj98SmefTmbqbUTOztKl5PDPiu0LD/A==" crossorigin="anonymous"></script>
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <div  class="text-center text-white">
                <div>
                    <h1 class="text-white text-center">Animes</h1>
{{--                    Search Bar--}}
                    <div class="container mb-5">
                        <form method="GET" action="#" class="form-inline my-2 my-lg-0 justify-content-center text-center" role="search">
{{--                            Filter function--}}
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <option class="dropdown-item" disabled>--Select Genre--</option>
                                <a href="#" class="dropdown-item">All Genres</a>
                                @foreach($genres as $genre)
                                    <a href="" class="dropdown-item" value="{{$genre->id}}">{{ $genre->genre_name }}</a>
                                @endforeach
                            </div>
{{--                            Search function--}}
                                <input type="text" name="search" placeholder="Search for Anime"
                                    class="form-control bg-transparent placeholder-glow font-semibold text-sm text-white"
                                    autocomplete="off" value="{{request('search')}}">
{{--                            <button class="btn btn-dark" style="outline: none" type="submit"><i class="fas fa-search"></i></button>--}}
                        </form>
                        @if(sizeof($animes) == 0)
                            <h5 class="text-center p-3">No results found...</h5>
                        @endif
                    </div>
{{--                    For loop for the Anime Cards--}}
                    <div id="container" class="container">
                        @foreach($animes as $anime)
                            <div class="cards" id="cards">
                                <a href="{{ route('anime.show', $anime) }}">
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
</body>

