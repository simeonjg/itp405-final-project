<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $primaryKey = 'ArtistId'; // not "id"

    public function albums()
    {
        // 2nd arg = Foreign key
        // 3rd arg = Primary key
        return $this->hasMany(Album::class, 'ArtistId', 'ArtistId');
    }
}
