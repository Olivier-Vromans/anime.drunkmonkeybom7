@php
    /**
    * @var User $user
    *
    *
    **/use App\Models\User;
@endphp
@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="/css/styles.css">
@endsection
@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <div class="container">
                <h1>Your Profile</h1>
                <div class="main-body text-dark">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card-body">
                                <div class="flex-column align-items-center image-box">
                                    <img src="{{asset("/storage/images/profile_picture/".$user->profile_picture)}}"
                                         alt="Admin" class="rounded-circle" width="200">
                                    <div class="row">
                                        <div class="col text-light">
                                            <h6 class="mb-0">Firstname</h6>
                                        </div>
                                        <div class="col text-secondary">
                                            {{$user->firstname}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col text-light">
                                            <h6 class="">Lastname</h6>
                                        </div>
                                        <div class="col text-secondary">
                                            {{$user->lastname}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col text-light">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col text-secondary">
                                            {{$user->username}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col text-light">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col text-secondary">
                                            {{$user->email}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 text-dark">
                                            <a class="btn btn-info " href="{{route('user.edit', $user)}}">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($user->anime()->exists() && count($user->anime()->get()) >= 2)
                            <div class="col mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="align-items-center mb-3">Your Favorites</h6>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">image</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Unfavorite</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($favorites as $favorite)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('anime.show', $favorite) }}">
                                                            <img
                                                                src="{{ asset("/storage/images/image_show/".$favorite->image_show) }}"
                                                                alt="" height="100px" width="100px">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('anime.show', $favorite) }}"
                                                           class="text-decoration-none text-black">
                                                        {{$favorite->title}}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('unfavorite', $favorite)  }}"
                                                              method="post"
                                                              class="text-left" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <div class="col-sm-9 text-center">
                                                                    <input type="id" id="id" name="id"
                                                                           value="{{$favorite->id}}" hidden>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="form-group row justify-content-center text-center mr-5">
                                                                <div class="col-sm-2">
                                                                    <button type="submit"
                                                                            class="btn btn-secondary mb-2">
                                                                        Unfavorite
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

