<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

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

        return redirect()->back()
            ->with('Success', 'Comment Posted!');

    }
}
