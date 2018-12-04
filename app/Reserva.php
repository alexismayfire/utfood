<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cardapio;

class Reserva extends Model
{
    protected $fillable = ['usuario_id', 'cardapio_id', 'data'];

    protected $dates = ['created_at', 'updated_at', 'data'];

    public function cardapio()
    {
        return $this->belongsTo('\App\Cardapio');
    }
}
