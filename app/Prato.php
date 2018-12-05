<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Prato extends Model
{
    protected $appends = ['tipoNome'];

    public function getTipoNomeAttribute()
    {
        switch($this->tipo)
        {
            case 1:
                return 'Entrada';
                break;
            case 2:
                return 'Prato Principal';
                break;
            case 3:
                return 'Sobremesa';
                break;
        }
    }
}
