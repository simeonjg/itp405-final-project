<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $primaryKey = 'InvoiceLineId';

    public function track()
    {
        return $this->belongsTo(Track::class, 'TrackId');
    }
}
