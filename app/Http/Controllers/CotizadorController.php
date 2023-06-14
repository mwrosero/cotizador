<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Ism;

class CotizadorController extends Controller
{
    public function registroCliente(){
        return view('cotizador.registroCliente');
    }

    public function cotizador(){
        return view('cotizador.cotizacion');
    }

    public function clientes(Request $request){
        /*$method = '/comercial/v1/clientes';
        $param = '?codigoSucursal='.Ism::CODIGOSUCURSAL;

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            'token'    => $response->data->idToken,
            'method'   => 'GET'
        ]);*/
        return view('cotizador.clientes');
    }

    public function cotizaciones(){
        return view('cotizador.cotizaciones');
    }
}
