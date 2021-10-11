@php
    /**
    * @var Anime $anime
    * use App\Models\Anime;
    **/
@endphp
@extends('layouts.layout')
<!--Navigation-->
@section('head')
{{--Load in DataTable--}}
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" defer></script>

{{--Styling of the DataTable--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.foundation.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/home.css">

{{--Fixings--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endsection
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
                <div class="card-header">
                    <h1>Overview for all Animes</h1>
                <table id="animes" class="label table dataTable table-striped table-dark" width="100%">
                    <thead>
                    <tr>
                        <th colspan="14">Animes</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Episodes</th>
                        <th>Rating</th>
                        <th>Genre_id</th>
                        <th>Language_id</th>
                        <th>User_favorite</th>
                        <th>Year</th>
                        <th>Image_Card</th>
                        <th>Image_Show</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animes as $anime)
                        <tr>
                            <td data-id="{{ $anime->id }}">{{ $anime->id }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->title }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->description }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->episodes }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->rating }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->genre_id }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->language_id }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->user_favorite }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->year }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->image_card }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->image_show }}</td>
                            <td data-id="{{ $anime->id }}">{{ $anime->status }}</td>
                            <td data-id="{{ $anime->id }}"><a href="{{ url("") }}"><i class="fas fa-edit btnedit" id="edit" aria-hidden="true"></i></a></td>
                            <td data-id="{{ $anime->id }}"><a href="{{ url("") }}"><i class="fas fa-trash btntrash" id="delete" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{asset("js/main.js")}}"></script>
@endsection
</body>
