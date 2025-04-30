@extends('layout')

@section('title', 'Details - ' . $response['title'])

@section('main')

    <!-- Alert section -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

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
                    <p class="mb-0"><strong>Rating: </strong></p><span class="badge bg-warning mb-4"><i class="bi bi-star-fill bg-"></i> {{ $response['vote_average'] }} /10</span>

                    <!-- Release Date -->
                    <p class="">
                        <strong>Release Date:</strong> {{ date('F j, Y', strtotime($response['release_date'])) }}
                    </p>

                    <!-- Favorites Button -->
                    <form action="{{ route('favorites.add', ['id' => $response['id']]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info">
                            <i class="bi bi-heart-fill"></i> Add to Favorites
                        </button>
                    </form>

                    <!-- Comment Section -->
                    <h3 class="mt-5 mb-4">Edit Comment Below:</h3>

                    <!-- Display Comments     -->
                     <div class="card mb-5">
                        <div class="card-body p-0">
                            @if ($commentCount > 0)
                                @foreach($comments as $comment)
                                    <div class="p-3 border-bottom">
                                        <!-- Allow user to edit chosen comment -->
                                        @if ($comment->user_id == $user->id)
                                        
                                            @if ($comment->id == $updating->id)
                                                <h5 class="text-info"><i class="bi bi-person-circle"></i>   {{ $comment->user->username }}</h5>
                                                <form action="{{ route('comments.update', ['id' => $comment['id']]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea
                                                            class="form-control @error('body') is-invalid @enderror"
                                                            name="comment"
                                                            id="comment"
                                                            
                                                        >{{ old('comment', $comment->body) }}</textarea>
                                                        @error ('comment')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </form>
                                                
                                            @else
                                                <h5 class="text-info"><i class="bi bi-person-circle"></i>   {{ $comment->user->username }}</h5>
                                                <p>{{ $comment->body }}</p>
                                                <small class="text-muted">{{ date_format($comment->updated_at, 'n/j/Y') }} at {{ date_format($comment->updated_at, 'g:i A') }} </small>
                                            @endif
                                                
                                            
                                        @else
                                            <h5 class=""><i class="bi bi-person-circle"></i>   {{ $comment->user->username }}</h5>
                                            <p>{{ $comment->body }}</p>
                                            <small class="text-muted">{{ date_format($comment->updated_at, 'n/j/Y') }} at {{ date_format($comment->updated_at, 'g:i A') }} </small>
                                        @endif
                                    </div>
                                    
                                @endforeach
                            @else
                                <h6 class="p-2">No comments yet. Be the first to leave your thoughts!</h6>
                            @endif
                        </div>
                        
                     </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
    
    

    
@endsection