<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Comment;

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
}
