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

@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <div  class="text-center text-white">
                <div>
                    <h1 class="text-white text-center">Animes</h1>
                    <div class="container">
                        <form class="form-inline my-2 my-lg-0 justify-content-center text-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" >--Select Genre--</a>
                                @foreach($genres as $genre)
                                    <a class="dropdown-item" href="{{route('genre', $genre)}}">{{ $genre->genre_name }}</a>
                                @endforeach
                            </div>
                            <label>
                                <input type="text" class="form-control" placeholder="Search for Anime">
                            </label>
                            <button class="btn btn-dark" style="outline: none" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

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
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
</body>

