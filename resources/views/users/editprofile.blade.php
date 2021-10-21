@php

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
                <form action="{{ route('user.update', $user)  }}" method="post" class="text-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <legend>Edit Profile</legend>
{{--                        Firstname--}}
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">Firstname</label>
                            <div class="col-sm-9">
                                <input type="text" id="firstname" name="firstname" value="{{$user->firstname}}" class="form-control" placeholder="Firstname">
                            </div>
                        </div>
{{--                        Lastname --}}
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 col-form-label">Lastname</label>
                            <div class="col-sm-9">
                                <input type="text" id="lastname" name="lastname" value="{{$user->lastname}}" class="form-control" placeholder="Firstname">
                            </div>
                        </div>
{{--                        Username --}}
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control" placeholder="Firstname">
                            </div>
                        </div>
{{--                        Profile Picture--}}
                        <div class="form-group row">
                            <label for="profile_picture" class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <input type="file" id="profile_picture" name="profile_picture" class="form-control-file">
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
