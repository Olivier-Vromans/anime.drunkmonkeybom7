@php
    use App\Models\Anime;use App\Models\Genre;
    /**
    * @var Genre $genres
    * @var Anime $anime
    *
    **/
@endphp
@extends('layouts.layout')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
@endsection
@section('nav')
@endsection
<body>
@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <div class="container">
                @if(session('status'))
                    <h4 class="alert alert-success">{{ session('status') }}</h4>
                @endif
                @if(session('danger'))
                    <h4 class="alert alert-danger">{{session('danger')}}</h4>
                @endif
                <form action="{{ route('anime.store')  }}" method="post" class="text-left"
                      enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend>Add New Anime</legend>
                        {{--Title--}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="title" name="title" value="{{session('anime.title')}}"
                                       class="form-control" placeholder="Anime Title" required>
                            </div>
                        </div>
                        {{--Description --}}
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea id="description" class="form-control" name="description" cols="40" rows="5"
                                          placeholder="Anime Description">{{session('anime.description')}}</textarea>
                            </div>
                        </div>
                        {{--Genre --}}
                        <div class="form-group row">
                            <label for="genre_id" class="col-sm-3 col-form-label">Genres</label>
                            <div class="col-sm-9" style="color: #495057">
                                <select id='myselect' name="genre_id[]" multiple>
                                    <option value="">Select An Option</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--Episodes--}}
                        <div class="form-group row">
                            <label for="episodes" class="col-sm-3 col-form-label">Episodes</label>
                            <div class="col-sm-5">
                                <input type="number" id="episodes" name="episodes" value="{{session('anime.episodes')}}"
                                       class="form-control" placeholder="Anime Episodes" min="1">
                            </div>
                        </div>
                        {{--Rating--}}
                        <div class="form-group row">
                            <label for="rating" class="col-sm-3 col-form-label">Rating</label>
                            <div class="col-sm-5">
                                <input type="number" id="rating" name="rating" value="{{session('anime.rating')}}"
                                       class="form-control" placeholder="Anime Rating" min="0" max="10" step="0.01">
                            </div>
                        </div>
                        {{--Year--}}
                        <div class="form-group row">
                            <label for="year" class="col-sm-3 col-form-label">Year</label>
                            <div class="col col-sm-5">
                                <select type="text" id="season" name="season" list="season-list" class="form-control">
                                    <option selected disabled>Premiere Season</option>
                                    <option value="Spring"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Spring")) ? 'selected' : '' }}
                                    >Spring
                                    </option>
                                    <option value="Summer"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Summer")) ? 'selected' : '' }}
                                    >Summer
                                    </option>
                                    <option value="Fall"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Fall")) ? 'selected' : '' }}
                                    >Fall
                                    </option>
                                    <option value="Winter"
                                        {{ (substr(session('anime.year'), 0, -5) == ("Winter")) ? 'selected' : '' }}
                                    >Winter
                                    </option>
                                </select>
                            </div>
                            <div class="col col-sm-4">
                                <input type="number" id="year" name="year" value="{{substr(session('anime.year'), -4)}}"
                                       class="form-control" placeholder="Anime Year" min="1900" max="2900">
                            </div>
                        </div>
                        {{--Image_Card--}}
                        <div class="form-group row">
                            <label for="image_card" class="col-sm-3 col-form-label">Image Card</label>
                            <div class="col-sm-9">
                                <input type="file" id="image_card" name="image_card" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image_show" class="col-sm-3 col-form-label">Image Show</label>
                            <div class="col-sm-9">
                                <input type="file" id="image_show" name="image_show" class="form-control-file">
                            </div>
                        </div>
                        {{--Status--}}
                        <div class="form-group row">
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
    <script>
        $('#myselect').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    </script>
@endsection
</body>
