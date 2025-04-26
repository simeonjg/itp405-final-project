<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $primaryKey = 'TrackId';

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'GenreId');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumId');
    }
}
