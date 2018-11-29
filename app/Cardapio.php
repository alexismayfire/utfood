<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    /*
    private $pratos;

    public function __construct()
    {
        $this->pratos = $this->carregarPratos();
    }

    private function carregarPratos()
    {
        return Prato::where('cardapio', $this->id);
    }
    */

    public function pratos()
    {
        return $this->hasMany('\App\Prato', 'cardapio');
    }
}
