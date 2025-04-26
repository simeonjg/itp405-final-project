<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Http\Resources\AlbumResource;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Album::all();

        // $paginatedAlbums = Album::paginate();
        // return $paginatedAlbums;

        // $paginatedAlbums = Album::paginate();
        // return response()->json($paginatedAlbums->items());

        return AlbumResource::collection(Album::simplePaginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->input(), [
            'Title' => 'required',
            'ArtistId' => 'required'
        ]);

        if($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 422);
        }

        // $album = new Album();
        // $album->save();

        $album =  Album::create($request->all());
        return new AlbumResource($album);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album, Request $request)
    {
        if ($request->query('include')) {
            $relationshipsToLoad = explode(',', $request->query('include')); // ['tracks', 'artist']

            // ideally more checks so consumers can't request any relationship
            $album->load($relationshipsToLoad);
        }

        return new AlbumResource($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validation = Validator::make($request->input(), [
            'Title' => 'required',
            'ArtistId' => 'required'
        ]);

        if($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 422);
        }

        $album->update($request->all());

        return new AlbumResource($album);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $trackCount = DB::table('tracks')
            ->where('AlbumId', '=', $album->Albumid)
            ->count();

        if ($trackCount > 0) {
            return response()->json([
                'error' => 'Only albums without tracks can be deleted',
            ], 409);
        }

        $album->delete();

        return response(null, 204);
    }
}
