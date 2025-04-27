<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Http;

class FavoritesController extends Controller
{
    // Display user's favorites
    public function index()
    {
        $user = Auth::user();

        $userId = $user->id;

        // Get movie_ids
        $favorites = Favorite::where('user_id', $userId)->get();

        // Get response for each movie_id
        $movies = [];
        foreach ($favorites as $favorite) {
            $response = Http::get("https://api.themoviedb.org/3/movie/{$favorite->movie_id}", [
                'api_key' => env('TMDB_API_KEY'),
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $data['time_added'] = $favorite->created_at;
                $movies[] = $data;
            }
        }

        return view('favorites.index', [
            'user' => $user,
            'movies' => $movies,
            'movieCount' => count($movies),
        ]);
    }

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

    // Add to user's favorites
    public function add($id)
    {
        $user = Auth::user();

        // Check if user has already added this movie to their favorites
        $currentFavorite = Favorite::where('user_id', $user->id)
            ->where('movie_id', $id)
            ->first();

        if ($currentFavorite) {
            return redirect()->back()
                ->with('error', 'Movie is already in favorites');

        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->movie_id = $id;
            $favorite->save();

            return redirect()->back()
                ->with('success', 'Added to favorites!');
        }
        
    }

    // Remove from user's favorites
    public function remove($id)
    {
        $user = Auth::user();

        // Find favorite to remove
        $deleted = Favorite::where('user_id', $user->id)
            ->where('movie_id', $id)
            ->delete();

        return redirect()->back()
            ->with('success', 'Movie removed from favorites');
        
    }

}
