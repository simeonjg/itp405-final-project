@extends('layout')

@section('title', 'Home - ' . $user->username)

@section('main')

    <!-- Alert section -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header section -->
    <div>
        <h1 class="mb-3 mx-auto">Hi, {{ $user->username }}</h1>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('search.results') }}" method="GET" class="d-flex">
            @csrf
            <input type="text" 
                   name="search-term" 
                   class="form-control me-2" 
                   placeholder="Search movies...">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <!-- Trending Section -->
    <div>
        <h3 class="">Trending this Week</h3>
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
    
    


    
@endsection