@php
    /**
    * @var Anime $anime
    * use App\Models\Anime;
    **/
@endphp
@extends('layouts.layout')
<!--Navigation-->
@section('head')

@endsection
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <h1>Welcome Admin</h1>
            <p> You are amazing </p>

                <div class="card-header">
                    <h1>Overview for all Animes</h1>
                    <table class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Users Favorite</th>
                                <th scope="col">Year</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($animes as $anime)
                            <tr>
                                <td>{{ $anime->id }}</td>
                                <td>{{ $anime->title }}</td>
                                <td>{{ $anime->user_favorite }}</td>
                                <td>{{ $anime->year }}</td>
                                <td>{{ $anime->status }}</td>
{{--                                <td><a href="{{ url() }}">Details</a></td>--}}
{{--                                <td><a href="{{ url() }}">Edit</a></td>--}}
{{--                                <td><a href="{{ url() }}">Delete</a></td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            <div class="card-body">
                <table id="animes" class="table dataTable table-striped table-light" width="100%">
                    <thead>
                    <tr>
                        <th colspan="14">Contact Informatie</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Email</th>
                        <th>Telefoon nummer</th>
                        <th>adres</th>
                        <th>Postcode</th>
                        <th>Plaats</th>
                        <th>Provincie</th>
                        <th>Hoeveel Producten</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Aanpassen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animes as $anime)
                        <tr>
                            <td data-id="{{ $anime->id }}">{{ $anime->id }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->title }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->user_favorite }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->year }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->status }}</td>
                            {{--                                <td><a href="{{ url() }}">Details</a></td>--}}
                            {{--                                <td><a href="{{ url() }}">Edit</a></td>--}}
                            {{--                                <td><a href="{{ url() }}">Delete</a></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{asset("js/main.js")}}"></script>
@endsection
</body>
