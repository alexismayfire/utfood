<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use App\Cardapio;
use App\Reserva;
use App\Calendario;
use App\Periodo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function reservasUsuario($usuario)
    {
        return Reserva::where('usuario_id', $usuario->id)->get();
    }

    public function agenda(Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        return view(
            'estabelecimento.reservas',
            compact('estabelecimento', 'cardapio')
        );
    }

    public function horariosDisponiveis(Estabelecimento $estabelecimento, Cardapio $cardapio, $dataEscolhida)
    {
        $carbonData = new Carbon($dataEscolhida);
        $reservas = Reserva::select('data', DB::raw('count(*) as total'))
            ->where('cardapio_id', $cardapio->id)
            ->whereDate('data', $carbonData)
            /*
            ->groupBy(function($reserva) {
                return $reserva->data;
                //return Carbon::parse($date->data)->format('d/m/Y');
            })
            */
            ->groupBy('data')
            ->pluck('total', 'data');

        // TODO: Cardapio precisa definir um limite de reserva por período (por hora)
        $limite = 5;

        // TODO: Cardapio também precisa definir, se será servido no Almoco, Jantar ou Todos
        $calendario = new Calendario(Periodo::Todos);

        foreach($reservas as $key => $qtd) {
            $horario = new Carbon($key);
            $hora = (int)$horario->format('H');

            if ($qtd >= $limite)
                $calendario->horarios[$hora] = false;
        }

        return [$calendario->horarios];
    }

    public function reservar(Request $request, Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        // TODO: Cardapio também precisa definir, se será servido no Almoco, Jantar ou Todos
        $calendario = new Calendario(Periodo::Todos);
        $horaEscolhida = null;

        // Checagem caso o user tente manipular o radio input
        if (array_key_exists($request->input('hora'), $calendario->horarios)) {
            $horaEscolhida = $request->input('hora');
        }
        /*
        foreach($request->all() as $key => $value) {
            if (array_key_exists($key, $calendario->horarios)) {
                $horaEscolhida = $key;
            }
        }
        */
        if ($horaEscolhida) {
            $carbonData = new Carbon($request->input('data'));
            $carbonData->hour($horaEscolhida);
            $reservas = Reserva::select('data', DB::raw('count(*) as total'))
                ->where('cardapio_id', $cardapio->id)
                ->whereDate('data', $carbonData)
                ->groupBy('data')
                ->pluck('total', 'data');

            // TODO: Cardapio precisa definir um limite de reserva por período (por hora)
            $limite = 5;
            $novaReserva = null;

            if ($reservas->isEmpty()) {
                $novaReserva = Reserva::create([
                    'usuario_id' => Auth::user()->id,
                    'cardapio_id' => $cardapio->id,
                    'data' => $carbonData->hour($horaEscolhida)
                ]);
            } else {
                foreach($reservas as $key => $qtd) {
                    $horario = new Carbon($key);

                    if ($horario->eq($carbonData))
                    {
                        // Achamos data e hora para testar se reservas esgotaram ("concorrência")
                        if ($qtd < $limite) {
                            // Pode marcar, tem horário disponível
                            $novaReserva = Reserva::create([
                                'usuario_id' => Auth::user()->id,
                                'cardapio_id' => $cardapio->id,
                                'data' => $carbonData->hour($horaEscolhida)
                            ]);
                            break;
                        }
                    }
                }
            }

            if ($novaReserva) {
                return redirect()->route('minhas_reservas');
            } else {
                // Usuário pode ter manipulado o checkbox disabled via console
                $horarioCheio = true;

                return view(
                    'estabelecimento.reservas',
                    compact('estabelecimento', 'cardapio', 'horarioCheio')
                );
            }

        } else {
            return 'Seleciona o bagulho brother';
        }
    }
}
