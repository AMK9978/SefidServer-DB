<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
