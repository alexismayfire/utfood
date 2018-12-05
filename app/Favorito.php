<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    public function favoritado()
    {
        return $this->morphTo();
    }
}
