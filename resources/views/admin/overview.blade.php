@php
    use App\Models\Anime;use App\Models\Genre;
    /**
    * @var Anime $anime
    * @var Genre $genre
    *
    **/
@endphp
@extends('layouts.layout')
<!--Navigation-->
@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{--Load in DataTable--}}
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" defer></script>

{{--Styling of the DataTable--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.foundation.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/admin.css">

{{--Fixings--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/dataRender/ellipsis.js"></script>

{{--Ajax loading in--}}
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

{{--Cloudlfare Toggle--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@endsection
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            @if(session('status'))
                <h4 class="alert alert-success">{{ session('status') }}</h4>
            @endif
            <div class="create text-left text-decoration-none">
                <a href="{{ route('anime.create') }}" class="text-gray-200">+ Add new Anime </a>
            </div>
                <div class="card-header">
                    <h1>Overview for all Animes</h1>
                <table id="animes" class="label table dataTable table-striped table-dark" width="100%">
                    <thead>
                    <tr>
                        <th colspan="14">Animes</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Episodes</th>
                        <th>Rating</th>
                        <th>Genres</th>
                        <th>Year</th>
                        <th>Image_Card</th>
                        <th>Image_Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animes as $anime)
                        <tr>
                            <td data-id="{{ $anime->id }}">{{ $anime->id }}</td>
                            <td data-id="{{ $anime->id }}">
                                <input type="checkbox" data-id="{{ $anime->id }}" name="status" class="js-switch" {{ $anime->status == 1 ? 'checked' : '' }}>
                            <td data-id="{{ $anime->id }}">{{ $anime->title }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->description }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->episodes }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->rating }}</td>
                            <td data-id="{{ $anime->id }}">
                                @foreach($anime->genres as $genre)
                                {{ $genre->name }}
                                @endforeach
                            </td>
                            <td data-id="{{ $anime->id }}">{{ $anime->year }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->image_card }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->image_show }}</td>
                            <td data-id="{{ $anime->id }}"><a href="{{ route('anime.edit', $anime) }}"><i class="fas fa-edit btnedit" id="edit" aria-hidden="true"></i></a></td>
                            <td data-id="{{ $anime->id }}">
                                <form action="{{route('anime.destroy', $anime)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="fas fa-trash btntrash" id="delete" aria-hidden="true"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        //get everuthing with the id js-switch
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        //loop through all js-switches and make a switch out of it
        elems.forEach(function(html) {
            let switchery = new Switchery(html,  { size: 'small' });
        });
    </script>
    <script src="{{asset("js/main.js")}}"></script>
@endsection
</body>
