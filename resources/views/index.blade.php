@extends('layout')

@section('title', 'MovieBuff')

@section('main')
    <div class="welcome-page">
        <!-- Welcome section -->
        <div class="jumbotron jumbotron-fluid bg-dark text-white text-center mb-0" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;">
            <div class="container py-5">
                <h1 class="display-4 font-weight-bold">Welcome to MovieBuff</h1>
                <p class="lead">Your hub for all things movies</p>
                <div class="mt-4">
                    <!-- <a href="{{ route('registration.index') }}" class="btn btn-primary btn-lg px-4 mr-3">Join Now</a> -->
                    <a href="/login" class="btn btn-primary btn-lg px-4 mx-auto">Get Started</a>
                </div>
            </div>
        </div>

        <!-- Description section -->
        <div class="container-fluid py-5 bg-light text-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="display-4 mb-3"><i class="bi bi-camera-reels"></i></div>
                                <h3 class="card-title">Browse Movies</h3>
                                <p class="card-text">Search across an extensive movie database to find your next movie adventure</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="display-4 mb-3"><i class="bi bi-chat-right-text"></i></div>
                                <h3 class="card-title">Talk your Talk</h3>
                                <p class="card-text">Comment on your favorite movies and discuss with other movie buffs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <div class="display-4 mb-3"><i class="bi bi-heart"></i></div>
                                <h3 class="card-title">Find your Favs</h3>
                                <p class="card-text">Add movies to your favorites to keep up with the latest comments and reactions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection