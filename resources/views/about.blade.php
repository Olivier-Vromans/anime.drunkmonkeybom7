@extends('layouts.layout')
<!--Navigation-->
@section('nav')
@endsection
<body>
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <h1>{{ htmlentities($title) }}</h1>
            <p> {{ htmlentities($paragraph) }} </p>
        </div>
    </div>
@endsection
</body>




