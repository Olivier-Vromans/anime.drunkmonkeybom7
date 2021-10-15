@php
    /**
    * @var Anime $anime
    *
    **/use App\Models\Anime;
@endphp
@extends('layouts.layout')
<!--Navigation-->
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            @if(Route::has('anime.index'))
                <div  class="text-center text-white">
                    <h1>Hello to the page of animes</h1>
                </div>
{{--        TODO MAKE THIS WORK AGAIN --}}
            @elseif(Route::has('anime.show'))
                <img style="height: 300px" src="{{ asset("/storage/images/".$anime->image_show) }}">
                <h1>{{ $anime->title }}</h1>
                <span>{{$anime->episodes}} episodes</span>
                <span>{{$anime->premiered}}</span>
            @endif
        </div>
    </div>
@endsection
</body>

