<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    // TODO: baita gambiarra!
    public function usuario()
    {
        return User::find($this->usuario);
    }

    public function avaliado()
    {
        return $this->morphTo();
    }
}
