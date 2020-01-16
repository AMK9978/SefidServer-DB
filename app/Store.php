<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function quiz_games()
    {
        return $this->hasMany(QuizGame::class);
    }

    public function q_r_code()
    {
        return $this->hasOne(QRCode::class);
    }

    public function offs()
    {
        return $this->hasMany(Off::class);
    }
}
