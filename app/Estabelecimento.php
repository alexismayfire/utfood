<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'endereco', 'telefone'];

    public function cardapios()
    {
        return $this->hasMany('App\Cardapio');
    }
}
