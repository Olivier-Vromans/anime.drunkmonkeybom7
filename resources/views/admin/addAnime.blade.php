@php

    /**
    * @var Genre $genre
    * @var Language $languages
    *
    **/ use App\Models\{Genre,Language};
@endphp
@extends('layouts.layout')
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <div class="container">
                @if(session('status'))
                    <h4 class="alert alert-success">{{ session('status') }}</h4>
                 @endif
                <div class="header">
                    <h1>Add new Anime</h1>
                </div>
                    <form action="{{ url('addAnime')  }}" method="post" class="text-left">
{{--                        Title--}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Anime Title">
                            </div>
                        </div>
{{--                        Description --}}
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" cols="40" rows="5" placeholder="Anime Description"></textarea>
                            </div>
                        </div>
{{--                        Genres--}}
                        <div class="form-group row">
                            <label for="genres" class="col-sm-3 col-form-label">Genres</label>
                            <div class="col-sm-9">
                                @foreach($genres as $genre)
                                    <input id="genres" type="checkbox" value="{{ $genre->id }}">{{$genre->genre_name }}</input>
                                @endforeach
                            </div>
                        </div>
{{--                        TODO DECIDE IF THIS NEEDS TO BE IN IT languages--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="language" class="col-sm-3 col-form-label">language</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                @foreach($languages as $language)--}}
{{--                                    <input id="language" type="checkbox" value="{{ $language->id }}">{{$language->language_name }}--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}



{{--                        $anime->episodes = $request->input('episodes');--}}
{{--                        $anime->users_favorite = $request->input('users_favorite');--}}
{{--                        $anime->rating = $request->input('rating');--}}
{{--                        $anime->year = $request->input('year');--}}
{{--                        $anime->comment_id = $request->input('comment_id');--}}
{{--                        $anime->image_card = $request->input('image_card');--}}
{{--                        $anime->image_show = $request->input('image_show');--}}
{{--                        $anime->status = $request->input('status');--}}


{{--                        TODO REMOVE COMMENTS NOW ITS ANNOYING--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="image_card" class="col-sm-3 col-form-label">Image Card</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input type="file" class="form-control-file" id="image_card">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="image_show" class="col-sm-3 col-form-label">Image Show</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input type="file" class="form-control-file" id="image_show">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
</body>
