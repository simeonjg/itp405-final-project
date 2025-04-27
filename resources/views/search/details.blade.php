@extends('layout')

@section('title', 'Details - ' . $response['title'])

@section('main')

    <div class="mb-4">
        <a href="{{ route('search.home') }}" class="btn btn-primary">Back to Home</a>
    </div>

    <!-- Details Section -->
    <div>
        <div class="row">
            <!-- Poster Section -->     
            <div class="col-md-5 col-lg-4 mb-4">
                <div class="position-relative">
                    <!-- Poster -->
                    <img src="https://image.tmdb.org/t/p/w500{{ $response['poster_path'] }}" 
                            alt="{{ $response['title'] }} poster"
                            class="img-fluid rounded-3 mb-2"> 
                </div>
            </div>
           

            <!-- Text Section -->
            <div class="col-md-7 col-lg-8">
                <div class="ps-md-4">
                    <!-- Title -->
                    <h1 class="mb-3 mx-auto">{{ $response['title'] }}</h1>
                    
                    <!-- Overview -->
                    <h6><strong>Overview:</strong></h6>
                    <p class="">{{ $response['overview'] }}</p>

                    <!-- Genres -->
                    <p class="mb-0"><strong>Genre(s):</strong></p>
                    @foreach ($response['genres'] as $genre)
                        <span class="badge bg-light mb-4">{{ $genre['name'] }}</span>
                    @endforeach

                    <!-- Rating -->
                    <p class="mb-0"><strong>Rating: </strong></p><span class="badge bg-warning mb-4"><i class="bi bi-star-fill bg-"></i> {{ $response['vote_average'] }}/10</span>

                    <!-- Release Date -->
                    <p class="">
                        <strong>Release Date:</strong> {{ date('F j, Y', strtotime($response['release_date'])) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    


    
@endsection