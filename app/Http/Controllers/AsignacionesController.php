<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Cliente;
use App\Models\Asignacione;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AsignacionesController extends Controller
{
    public function asignar(Cliente $cliente, $id)
    {
        // #1 = jYgzeKBx4db1m5wLQP6ZpLXNyroq2J8G
        // #2 = NEWJXBjLoxYkv7VQowezRMG8l6DQqKra
        $idDecoded = Hashids::decode($id);
        if (!$idDecoded) {
            $msg = "El codigo no existe!!!";
            $type = "error";

            return redirect()->route('voyager.dashboard')->with([
                'message'    => $msg,
                'alert-type' => $type,
            ]);
        }
        $cliente = Cliente::find($idDecoded[0]);
        if (!$cliente) {
            $msg = "El cliente no existe!!!";
            $type = "error";

            return redirect()->route('voyager.dashboard')->with([
                'message'    => $msg,
                'alert-type' => $type,
            ]);
        }
        $tortilleria = Auth::user()->id;
        $hoy = date('Y-m-d');

        $buscaAsignacion = Asignacione::where('cliente_id', '=', $cliente->id)->where('fecha_asignacion', '=', $hoy)->get();

        if ($buscaAsignacion->count() > 0) {
            $msg = "El cliente ya ha recibido su kilo de tortilla gratis";
            $type = "error";

            return redirect()->route('voyager.dashboard')->with([
                'message'    => $msg,
                'alert-type' => $type,
            ]);
        }

        $asignacion = new Asignacione();
        $asignacion->cliente_id = $cliente->id;
        $asignacion->user_id = $tortilleria;
        $asignacion->fecha_asignacion = $hoy;
        $asignacion->save();

        $msg = "El cliente puede recibir 1 kilo de tortilla gratis";
        $type = "success";



        return redirect()->route('voyager.dashboard')->with([
            'message'    => $msg,
            'alert-type' => $type,
        ]);

    }
}
