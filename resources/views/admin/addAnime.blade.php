@php
    use App\Models\Anime;use App\Models\Genre;
    /**
    * @var Genre $genres
    * @var Anime $anime
    *
    **/
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
                @if(session('danger'))
                    <h4 class="alert alert-danger">{{session('danger')}}</h4>
                @endif
                <form action="{{ url('anime/addAnime')  }}" method="post" class="text-left" enctype="multipart/form-data">
                    @csrf
{{--                    @dd(session('anime.year'))--}}
                    <fieldset>
{{--                        @dd(session('anime'))--}}
                        <legend>Add New Anime</legend>
{{--                        Title--}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" value="{{session('anime.title')}}" class="form-control" placeholder="Anime Title">
                            </div>
                        </div>
{{--                        Description --}}
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="description" class="form-control" name="description"  cols="40" rows="5" placeholder="Anime Description">{{session('anime.description')}}</textarea>
                            </div>
                        </div>
{{--                        Genres--}}
                        <div class="form-group row">
                            <label for="genre_id" class="col-sm-3 col-form-label">Genres</label>
                            <div class="col-sm-9">
                                @foreach($genres as $genre)
                                    <label>
                                        <input id="genre_id" name="genre_id[]" type="checkbox" value="{{ $genre->id }}"
                                        @if(session('animeGenres') == null)
                                        ''
                                        @else
                                            @foreach(session('animeGenres') as $animeGenre)
                                                {{ ($animeGenre == ($genre->id)) ? 'checked' : '' }}
                                            @endforeach
                                        @endif
                                        <span> {{ $genre->genre_name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
{{--                        Episodes--}}
                        <div class="form-group row">
                            <label for="episodes" class="col-sm-3 col-form-label">Episodes</label>
                            <div class="col-sm-5">
                                <input type="number" id="episodes" name="episodes" value="{{session('anime.episodes')}}" class="form-control"  placeholder="Anime Episodes" min="1">
                            </div>
                        </div>
{{--                        Rating--}}
                        <div class="form-group row">
                            <label for="rating" class="col-sm-3 col-form-label">Rating</label>
                            <div class="col-sm-5">
                                <input type="number" id="rating" name="rating" value="{{session('anime.rating')}}" class="form-control"  placeholder="Anime Rating" min="0" max="10" step="0.01">
                            </div>
                        </div>
{{--                        Year--}}
{{--                        @dd(session('anime.year'))--}}
                        <div class="form-group row">
                            <label for="year" class="col-sm-3 col-form-label">Year</label>
                            <div class="col col-sm-5">
                                <select  type="text" id="season" name="season" list="season-list" class="form-control">
                                    <option selected disabled>Premiere Season</option>
                                    <option value="Spring"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Spring")) ? 'selected' : '' }}
                                    >Spring</option>
                                    <option value="Summer"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Summer")) ? 'selected' : '' }}
                                    >Summer</option>
                                    <option value="Fall"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Fall")) ? 'selected' : '' }}
                                    >Fall</option>
                                    <option value="Winter"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Winter")) ? 'selected' : '' }}
                                    >Winter</option>
                                </select>
                            </div>
                            <div class="col col-sm-4">
                                <input type="number" id="year" name="year" value="{{substr(session('anime.year'), -4)}}" class="form-control"  placeholder="Anime Year" min="1900" max="2900">
                            </div>
                        </div>
{{--                        Image_Card--}}
                        <div class="form-group row">
                            <label for="image_card" class="col-sm-3 col-form-label">Image Card</label>
                            <div class="col-sm-9">
                                <input type="file" id="image_card" name="image_card" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image_show" class="col-sm-3 col-form-label">Image Show</label>
                            <div class="col-sm-9">
                                <input type="file" id="image_show" name="image_show" class="form-control-file" >
                            </div>
                        </div>
{{--                        Status--}}
                        <div class="form-group row">
{{--                        <label for="status" class="col-sm-3 col-form-label">Status</label>--}}
                            <div class="col-sm-9">
                                <input type="hidden" id="image_show" name="status" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-secondary mb-2">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
</body>
