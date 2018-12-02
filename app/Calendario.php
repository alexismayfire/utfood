<?php

namespace App;


use phpDocumentor\Reflection\Types\Integer;

class Calendario
{
    public $periodo;
    public $horarios;

    public function __construct(array $periodo)
    {
        $this->periodo = $periodo;
        $this->horarios = [];

        if(is_array($this->periodo[0])) {
            // Significa que foi passado Periodo::Todos no construtor
            foreach ($this->periodo as $periodoAtual)
                for($i = $periodoAtual['inicio']; $i <= $periodoAtual['fim']; $i++)
                    $this->horarios[$i] = true;
        } else {
            // Só tem um período
            for($i = $this->periodo['inicio']; $i <= $this->periodo['fim']; $i++)
                $this->horarios[$i] = true;
        }
    }
}

abstract class Periodo {
    const Almoco = ['inicio' => 12, 'fim' => 14];
    const Jantar = ['inicio' => 19, 'fim' => 22];
    const Todos = [self::Almoco, self::Jantar];
}
