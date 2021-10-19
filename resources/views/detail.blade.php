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
            <img style="height: 300px" src="{{ asset("/storage/images/image_show/".$anime->image_show) }}" alt="">
            <h1>{{ $anime->title }}</h1>
            <span>{{$anime->episodes}} episodes</span><br>
            @foreach($anime->genres as $genre)
                <span>{{$genre->genre_name }}</span>
            @endforeach
            <span>{{$anime->premiered}}</span>
        </div>
    </div>
@endsection
</body>

