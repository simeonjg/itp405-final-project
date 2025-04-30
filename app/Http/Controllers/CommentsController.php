<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Http;

class CommentsController extends Controller
{
    // Post user's comment
    public function comment(Request $request, $id) 
    {
        $user = Auth::user();
        $movie_id = $id;

        $request->validate([
            'comment' => 'required|max:500',
        ]);

        $comment = new Comment();
        $comment->movie_id = $movie_id;
        $comment->user_id = $user->id;
        $comment->body = $request->input('comment');
        $comment->save();


        return redirect()->back()
            ->with('success', 'Comment Posted!');

    }


     // Remove user's comment
     public function remove($id)
     {
         $user = Auth::user();
 
         // Find comment to remove
         $deleted = Comment::where('id', $id)
             ->delete();
 
         return redirect()->back()
             ->with('success', 'Comment deleted');
         
     }

     // Show comment editor
     public function edit($id)
     {
         $user = Auth::user();
        
         // Find comment to Edit
         $updating = Comment::where('id', $id)
             ->first();

        // Get movie by its id
        $response = Http::get("https://api.themoviedb.org/3/movie/{$updating->movie_id}", [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        // Get comments for movie
        $comments = Comment::with('user')
            ->where('movie_id', $updating->movie_id)
            ->orderBy('updated_at', 'DESC')
            ->get();


 
         return view('comments.edit', [
            'updating' => $updating,
            'user' => $user,
            'response' => $response,
            'comments' => $comments,
            'commentCount' => count($comments),
         ]);
         
     }

     // Edit user's comment
     public function update(Request $request, $id)
     {
        $user = Auth::user();

        $request->validate([
            'comment' => 'required|max:500',
        ]);

         // Find and update comment
         $updating = Comment::where('id', $id)
             ->first();
         $updating->body = $request->input('comment');
         $updating->save();

 
         return redirect()
            ->route('search.details', ['id' => $updating->movie_id])
            ->with('success', 'Comment updated!');
         
     }
}
