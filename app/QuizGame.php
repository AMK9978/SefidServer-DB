<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizGame extends Model
{
    public function offs()
    {
        return $this->hasMany(Off::class);
    }

    public function questions()
    {
        return $this->hasMany(Option::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'game_user_table');
    }

}
