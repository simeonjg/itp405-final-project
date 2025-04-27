<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['user_id', 'movie_id'];

    // Get user from users table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
