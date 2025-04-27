@extends('layout')

@section('title', 'Results - ' . $term)

@section('main')

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('search.results') }}" method="GET" class="d-flex">
            @csrf
            <input type="text" 
                   name="search-term" 
                   class="form-control me-2" 
                   placeholder="Search movies..." 
                   value="{{ $term ?? '' }}">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
        </form>
    </div>

    

    @if ($resultCount > 0)
        <!-- Header section -->
        <div>
            <h1 class="mx-auto">Results for '{{ $term }}'</h1>
            <p class="mb-3">Showing {{ $resultCount }} results</p>
        </div>

        <!-- Results Section -->
        <div>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
                @foreach ($response['results'] as $result)
                    <div class="col">
                        <div class="h-100 mb-4">
                            <a href="{{ route('search.details', ['id' => $result['id']]) }}">
                                <div class="position-relative">
                                    <!-- Poster -->
                                    <img src="https://image.tmdb.org/t/p/w500{{ $result['poster_path'] }}" 
                                            alt="{{ $result['title'] }} poster"
                                            class="img-fluid rounded-3 mb-2"> 
                                </div>
                                
                                <!-- Title -->
                                <h6 class="text-truncate">{{ $result['title'] }}</h6>
                                
                                <!-- Release Date -->
                                <small class="text-muted">
                                    {{ date('M Y', strtotime($result['release_date'])) }}
                                </small>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div>
            <h1>Sorry, we can't find any results for '{{ $term }}'. Try searching for something else!</h1>
        </div>
    @endif
    
    
    


    
@endsection