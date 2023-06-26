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
        $tipoFiltro = $request->query('tipoFiltro', '');
        $valorFiltro = $request->query('valorFiltro', '');
        $customFilter = "";
        if($tipoFiltro != "" && $valorFiltro != ""){
            $customFilter = "&tipoFiltro=".$tipoFiltro."&valorFiltro=".urlencode($valorFiltro);
        }

        $method = '/comercial/v1/clientes';
        $param = '?page='.$request->query('page', '1').'&perPage='.Ism::PERPAGE.'&estado='.$request->query('estado', 'TODOS').'&infoEmpresarial=true&codigoCliente='.urlencode($request->query('codigoCliente', '')).'&tipoPersona='.$request->query('tipoPersona','').$customFilter;

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            'token'    => Session::get('userData')->idToken,
            'method'   => 'GET'
        ]);

        // echo Ism::BASE_URL.$method.$param;
        // dd($response);

        $totalRegistros = $response->data->totalRows; // Número total de registros
        $registrosPorPagina = count($response->data->row); // Número de registros en la página actual

        $elementosPorPagina = Ism::PERPAGE; // Define el número de elementos por página según tus necesidades
        $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

        $paginaActual = $request->query('page', '1'); // Define la página actual según tus necesidades
        $datosPaginados = new \Illuminate\Pagination\LengthAwarePaginator(
            $response->data->row, // Datos de la página actual
            $totalRegistros, // Número total de registros
            $elementosPorPagina, // Número de elementos por página
            $paginaActual, // Página actual
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), // Ruta actual
                'pageName' => 'page', // Nombre del parámetro de la página en la URL
            ]
        );

        return view('cotizador.clientes')
            ->with('datosPaginados', $datosPaginados)
            ->with('data',$response);
    }

    public function cotizaciones(){
        return view('cotizador.cotizaciones');
    }
}
