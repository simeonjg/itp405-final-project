<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    // Display trending movies on home page
    public function index()
    {
        // Get trending movies this week
        $response = Http::get('https://api.themoviedb.org/3/trending/movie/week', [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        return view('search.home', [
            'user' => Auth::user(),
            'response' => $response,
        ]);
    }

    // Display search results
    public function search(Request $request)
    {

        $term = $request->input('search-term');

        // Get movies that match search term
        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => env('TMDB_API_KEY'),
            'query' => $term,
        ]);

        return view('search.results', [
            'user' => Auth::user(),
            'response' => $response,
            'term' => $term,
            'resultCount' => $response['total_results'],
        ]);
    }

    // Show movie details
    public function show($id)
    {
        // Get movie by its id
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        // Get comments for movie
        $user = Auth::user();
        $comments = Comment::with('user')
            ->where('movie_id', $id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('search.details', [
            'user' => Auth::user(),
            'response' => $response,
            'comments' => $comments,
            'commentCount' => count($comments),
        ]);
    }

}
