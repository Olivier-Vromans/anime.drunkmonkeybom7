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
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" placeholder="Anime Title">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="image_card" class="col-sm-3 col-form-label">Image Card</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="image_card">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image_show" class="col-sm-3 col-form-label">Image Show</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="image_show">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
</body>
