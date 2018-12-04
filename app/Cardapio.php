<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    public function pratos()
    {
        return $this->hasMany('\App\Prato', 'cardapio');
    }

    public function estabelecimento()
    {
        return $this->belongsTo('\App\Estabelecimento');
    }
}
