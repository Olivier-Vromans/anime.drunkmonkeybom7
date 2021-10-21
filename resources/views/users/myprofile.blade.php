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
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
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

                        <div class="col mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="align-items-center mb-3">Your Favorites</h6>
                                    <small>Web Design</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Website Markup</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>One Page</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Mobile Template</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>Backend API</small>
                                    <div class="progress mb-3" style="height: 5px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection

