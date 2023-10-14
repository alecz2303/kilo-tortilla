<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Cliente;

class ClientesController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {

        $cliente = new Cliente();
        $cliente->nombre = $request->input('nombre');
        $cliente->ap_paterno = $request->input('ap_paterno');
        $cliente->ap_materno = $request->input('ap_materno');
        $cliente->telefono = $request->input('telefono');
        $cliente->idmex = $request->input('idmex');
        $cliente->save();

        $token = setting('admin.token_acceso');

        $id = $cliente->id;
        $idEncode = Hashids::encode($id);
        $url = 'http://kilo-tortilla-api.djira.xyz/api/items/'.$id.'/'.$idEncode.'/'.$token;
        $response = Http::post($url);

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            $data = $response->json(); // Parse the JSON response
            $msg = "El cliente ha sido dado de alta";
            $type = "success";
            return redirect()->route('voyager.clientes.index')->with([
                'message'    => $msg,
                'alert-type' => $type,
            ]);
        } else {
            // Handle the error (e.g., show an error message)
            return view('error', ['message' => 'API request failed']);
        }
    }
}
