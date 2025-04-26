@extends('layout')

@section('title', 'Details - ' . $response['title'])

@section('main')

    <!-- Header section -->
    <div>
        <h1 class="mb-3 mx-auto">{{ $response['title'] }}</h1>
    </div>

    {{$response}}

    <div>
        <a href="{{ route('search.home') }}" class="btn btn-primary">Back to Home</a>
    </div>

    <!-- Details Section -->
    <div>
        <table class="table table-striped">
        <thead>
            <tr>
            <th>Title</th>
            <th>Overview</th>
            <th>Release Date</th>
            <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $response['title'] }}</td>
                <td>{{ $response['overview'] }}</td>
                <td>{{ $response['release_date'] }}</td>
                <td><img src="https://image.tmdb.org/t/p/w200{{ $response['poster_path'] }}"></td>
            </tr>
        </tbody>
        </table>
    </div>
    
    


    
@endsection