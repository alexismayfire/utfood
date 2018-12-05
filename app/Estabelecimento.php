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
    protected $appends = ['url', 'cozinha'];

    public function tipoCozinha()
    {
        return $this->belongsTo('App\TipoCozinha');
    }

    public function cardapios()
    {
        return $this->hasMany('App\Cardapio');
    }

    public function avaliacoes()
    {
        //return $this->morphMany('App\Avaliacao', 'avaliado');
        return $this->hasMany('App\Avaliacao', 'tipo_conteudo_id')->where('tipos_conteudo', 1);
    }

    public function favoritos()
    {
        return $this->hasMany('App\Favorito', 'tipo_conteudo_id')->where('tipos_conteudo', 1);
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] = route('estabelecimento', ['estabelecimento' => $this->id]);
    }

    public function getCozinhaAttribute()
    {
        return $this->attributes['cozinha'] = $this->tipoCozinha->titulo;
    }
}
