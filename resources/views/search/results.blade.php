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
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Title</th>
                    <th>Overview</th>
                    <th>Release Date</th>
                    <th>Image</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($response['results'] as $result)
                    <tr>
                        <td>{{ $result['title'] }}</td>
                        <td>{{ $result['overview'] }}</td>
                        <td>{{ $result['release_date'] }}</td>
                        <td><img src="https://image.tmdb.org/t/p/w200{{ $result['poster_path'] }}"></td>
                        <td><a href="{{ route('search.details', ['id' => $result['id']]) }}" class="btn btn-primary">Details</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div>
            <h1>Sorry, we can't find any results for '{{ $term }}'. Try searching for something else!</h1>
        </div>
    @endif
    
    
    


    
@endsection