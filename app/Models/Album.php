<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $primaryKey = 'AlbumId';
    public $timestamps = false;

    protected $fillable = ['Title', 'ArtistId'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'ArtistId');
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, 'AlbumId');
    }
}
