<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function offs()
    {
        return $this->hasMany(Off::class);
    }

}
