<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AlbumController extends Controller
{
    public function create()
    {
        return view('albums.create', [
            'artists' => DB::table('artists')->orderBy('Name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // dd([
        //     'title' => $request->input('title'),
        //     'artist' => $request->input('artist'),
        // ]);

        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,ArtistId',
        ]);

        DB::table('albums')->insert([
            'Title' => $request->input('title'),
            'ArtistId' => $request->input('artist'),
        ]);

        $artist = DB::table('artists')
            ->where('ArtistId', '=', $request->input('artist'))
            ->first();

        return redirect()
            ->route('album.create')
            ->with('success', "Successfully created album {$request->input('title')} by {$artist->Name}");
    }
}
