<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Off extends Model
{
    public function quiz_game()
    {
        return $this->belongsTo(QuizGame::class);
    }
}
