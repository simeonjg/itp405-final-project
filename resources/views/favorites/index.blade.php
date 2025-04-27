@extends('layout')

@section('title', 'Favorites - ' . $user->username)

@section('main')

    <!-- Alert section -->
    @if (session('success'))
        <div class="alert alert-info" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header section -->
    <div>
        <h1 class="mb-3 mx-auto">{{ $user->username }}'s Favorites</h1>
    </div>

    
    <!-- Favorites Section -->
    <div>
        @if ($movieCount > 0)
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
                @foreach ($movies as $movie)
                    <div class="col">
                        <div class="h-100 mb-4">
                            <a href="{{ route('search.details', ['id' => $movie['id']]) }}">
                                <div class="position-relative">
                                    <!-- Poster -->
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                                            alt="{{ $movie['title'] }} poster"
                                            class="img-fluid rounded-3 mb-2"> 
                                </div>
                                
                                <!-- Title -->
                                <h6 class="text-truncate">{{ $movie['title'] }}</h6>
                                
                                <!-- Release Date -->
                                <small class="text-muted">
                                    {{ date('M Y', strtotime($movie['release_date'])) }}
                                </small>

                                <!-- Time Added -->
                                <div>
                                    <small class="text-info">
                                        <i class="bi bi-heart-fill"></i> 
                                        Added {{ date_format($movie['time_added'], 'n/j/Y') }} at {{ date_format($movie['time_added'], 'g:i A') }}
                                    </small>
                                </div>  
                            </a>
                            <!-- Remove -->
                            <div>
                                <form action="{{ route('favorites.remove', ['id' => $movie['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 border-0">
                                        <small class="text-danger">
                                            <i class="bi bi-trash-fill"></i> 
                                            Remove
                                        </small>
                                    </button>
                                </form>  
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        @else
            <!-- No Favorites Message    -->
            <h3>It looks like you don't have any favorites yet. View a movie's details to add it to your favorites!</h3>
        @endif
        
    </div>
    
    


    
@endsection