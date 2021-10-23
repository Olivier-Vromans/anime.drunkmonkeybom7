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
{{--    @dd($anime->user()->find(Auth::id()))--}}
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
    <div class="favorite">
{{--    Check if $anime has a relation with the id of the user--}}
        @if($anime->user()->find(Auth::id()))
            <form action="{{ route('unfavorite', $anime)  }}" method="post" class="text-left" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-9 text-center">
                        <input type="id" id="id" name="id" value="{{$anime->id}}" hidden>
                    </div>
                </div>
                <div class="form-group row justify-content-center text-center">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-secondary mb-2">Unfavorite</button>
                    </div>
                </div>
            </form>
        @elseif($anime->user()->find(Auth::id()) === null)
            <form action="{{ route('favorite', $anime)  }}" method="post" class="text-left" enctype="multipart/form-data">
                @csrf
                <div class="form-group row ">
                    <div class="col-sm-9">
                        <input type="id" id="id" name="id" value="{{$anime->id}}" hidden>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-2 text-center">
                        <button type="submit" class="btn btn-danger mb-2">Favorite</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
</body>

