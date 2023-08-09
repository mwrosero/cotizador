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

    public function cotizador($numeroIdentificacion = null){
        return view('cotizador.cotizacion')
            ->with('numeroIdentificacion', $numeroIdentificacion);
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
            'token'    => Session::get('accessToken'),
            'method'   => 'GET'
        ]);

        //echo Ism::BASE_URL.$method.$param;
        //dd($response);

        if($response->code == 200){
            $totalRegistros = $response->data->totalRows; // Número total de registros
            $registrosPorPagina = count($response->data->row); // Número de registros en la página actual
            $datos = $response->data->row;
        }else{
            $datos = [];
            $totalRegistros = 0; // Número total de registros
            $registrosPorPagina = count($datos); // Número de registros en la página actual
        }

        /*$totalRegistros = $response->data->totalRows; // Número total de registros
        $registrosPorPagina = count($response->data->row); // Número de registros en la página actual
        $datos = $response->data->row;*/

        $elementosPorPagina = Ism::PERPAGE; // Define el número de elementos por página según tus necesidades
        $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

        $paginaActual = $request->query('page', '1'); // Define la página actual según tus necesidades
        $datosPaginados = new \Illuminate\Pagination\LengthAwarePaginator(
            $datos, // Datos de la página actual
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

    public function cotizaciones(Request $request){
        $method = '/empresarial/v1/cotizacion';
        $param = '?page='.$request->query('page', '1').'&perPage='.Ism::PERPAGE.'&estado=TODOS&estadoCotizacion='.$request->query('estado', 'TODOS').'&codigoTipoContrato='.$request->query('codigoTipoContrato','');

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            'token'    => Session::get('accessToken'),
            'method'   => 'GET'
        ]);

        // echo Ism::BASE_URL.$method.$param;
        // dd($response);

        if($response->code == 200){
            $totalRegistros = $response->data->totalRows; // Número total de registros
            $registrosPorPagina = count($response->data->rows); // Número de registros en la página actual
            $datos = $response->data->rows;
        }else{
            $datos = [];
            $totalRegistros = 0; // Número total de registros
            $registrosPorPagina = count($datos); // Número de registros en la página actual
        }

        $elementosPorPagina = Ism::PERPAGE; // Define el número de elementos por página según tus necesidades
        $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

        $paginaActual = $request->query('page', '1'); // Define la página actual según tus necesidades
        $datosPaginados = new \Illuminate\Pagination\LengthAwarePaginator(
            $datos, // Datos de la página actual
            $totalRegistros, // Número total de registros
            $elementosPorPagina, // Número de elementos por página
            $paginaActual, // Página actual
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), // Ruta actual
                'pageName' => 'page', // Nombre del parámetro de la página en la URL
            ]
        );

        $method = '/comercial/v1/tipos_contratos?codigoTipoProducto=2&estado=ACTIVO';
        
        $responseContratos = Ism::call([
            'endpoint' => Ism::BASE_URL.$method,
            'token'    => Session::get('accessToken'),
            'method'   => 'GET'
        ]);

//echo Ism::BASE_URL.$method;dd($responseContratos);
        
        return view('cotizador.cotizaciones')
            ->with('datosPaginados', $datosPaginados)
            ->with('dataContratos',$responseContratos->data)
            ->with('data',$response);
    }

    public function obtenerInfoCliente($codigoCliente){
        $method = '/comercial/v1/clientes/'.$codigoCliente.'?infoEmpresarial=true';
        
        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method,
            'token'    => Session::get('accessToken'),
            'method'   => 'GET'
        ]);

        // dd($response);
        $cliente = $response->data;
        return view('cotizador.registroCliente', compact('cliente'))
                ->with('edit', true)
                ->with('codigoCliente',$codigoCliente);

    }

    public function crearCliente(Request $request){
        $data = $request->all();
        $idGrupoEmpresa = null;
        if(isset($data['grupoEmpresa'])){
            $idGrupoEmpresa = ($data['grupoEmpresa'] == "---") ? null : (int)$data['grupoEmpresa'];
        }
        
        $cliente = [
            "datosCliente" => [
                "tipoPersona" => $data['tipoPersona'],
                "codigoTipoIdentificacion" => (int)$data['codigoTipoIdentificacion'],
                "numeroIdentificacion" => $data['numeroIdentificacion'],
                "primerNombre" => null,
                "segundoNombre" => null,
                "primerApellido" => null,
                "segundoApellido" => null,
                "razonSocial" => $data['razonSocial'],
                "nombreComercial" => $data['razonComercial'],
                "aplicaPaperless" => false,
                "aplicaSolicitudEnvioPaperlessLote" => false,
                "bloquearCreditosPrestaciones" => false
            ],
            "datosContacto" => [
                "codigoPaisCelular" => (int)$data['telefonoMovilOficinaCode'],
                "telefonoCelular" => $data['telefonoMovilOficina'],
                "codigoPaisConvencional" => $data['telefonoFijoOficinaCode'],
                "telefonoConvencional" => $data['telefonoFijoOficina'],
                "contactoCliente" => null,
                "correoElectronico" => strtolower($data['correoEmpresa'])
            ],
            "datosResidencia" => [
                "codigoPais" => (int)$data['pais'],
                "codigoProvincia" => (int)$data['provincia'],
                "codigoCiudad" => (int)$data['ciudad'],
                "codigoSector" => null,
                "direccion" => $data['direccion'],
                "latitud" => null,
                "longitud" => null,
                "direccionGmaps" => null
            ],
            "infoEmpresarial" => [
                "codigoCiiu" => strval($data['codigoCiiu']),
                "representanteLegal" => $data['representanteLegal'],
                "idGiroNegocio" => (int)$data['giroNegocio'],
                "idGrupoEmpresa" => $idGrupoEmpresa,
                "contactoEmpresarial" => [
                    "codigoTipoIdentificacion" => null,
                    "numeroIdentificacion" => null,
                    "nombre" => $data['personaContacto'],
                    "codigoPaisCelular" => (int)$data['telefonoMovilContactoCode'],
                    "telefonoMovil" => $data['telefonoMovilContacto'],
                    "codigoPaisFijo" => $data['telefonoFijoContactoCode'],
                    "telefonoFijo" => $data['telefonoFijoContacto'],
                    "mail" => strtolower($data['correoContacto']),
                    "cargo" => $data['cargoPersonaContacto']
                ]
            ]
        ];

        $esGrupoEmpresa = "false";
        if ($request->has('esGrupoEmpresa')) {
            $esGrupoEmpresa = "true";
        }
        $method = '/comercial/v1/clientes';
        $param = '?esGrupoEmpresa='.$esGrupoEmpresa;

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            'token'    => Session::get('accessToken'),
            'data'     => $cliente,
            'method'   => 'POST'
        ]);
        
        // echo Ism::BASE_URL.$method.$param;
        // dump($cliente);
        // dd($response);
        // die();

        if($response->code != 200){
            session()->flash('mensaje', $response->message);
            return redirect()->back()->withErrors($request->all())->withInput();
        }else{
            session()->flash('success', "Cliente creado exitosamente");
            return redirect()->route('consulta-clientes');
            //return view('cotizador.clientes');
        }
        
    }

    public function actualizarCliente(Request $request){
        $data = $request->all();
        $idGrupoEmpresa = null;
        if(isset($data['grupoEmpresa'])){
            $idGrupoEmpresa = ($data['grupoEmpresa'] == "---") ? null : (int)$data['grupoEmpresa'];
        }

        $cliente = [
            "datosCliente" => [
                "tipoPersona" => $data['tipoPersona'],
                "codigoTipoIdentificacion" => (int)$data['codigoTipoIdentificacion'],
                "numeroIdentificacion" => $data['numeroIdentificacion'],
                "primerNombre" => null,
                "segundoNombre" => null,
                "primerApellido" => null,
                "segundoApellido" => null,
                "razonSocial" => $data['razonSocial'],
                "nombreComercial" => $data['razonComercial'],
                "aplicaPaperless" => false,
                "aplicaSolicitudEnvioPaperlessLote" => false,
                "bloquearCreditosPrestaciones" => false
            ],
            "datosContacto" => [
                "codigoPaisCelular" => (int)$data['telefonoMovilOficinaCode'],
                "telefonoCelular" => $data['telefonoMovilOficina'],
                "codigoPaisConvencional" => $data['telefonoFijoOficinaCode'],
                "telefonoConvencional" => $data['telefonoFijoOficina'],
                "contactoCliente" => null,
                "correoElectronico" => strtolower($data['correoEmpresa'])
            ],
            "datosResidencia" => [
                "codigoPais" => (int)$data['pais'],
                "codigoProvincia" => (int)$data['provincia'],
                "codigoCiudad" => (int)$data['ciudad'],
                "codigoSector" => null,
                "direccion" => $data['direccion'],
                "latitud" => null,
                "longitud" => null,
                "direccionGmaps" => null
            ],
            "infoEmpresarial" => [
                "codigoCiiu" => strval($data['codigoCiiu']),
                "representanteLegal" => $data['representanteLegal'],
                "idGiroNegocio" => (int)$data['giroNegocio'],
                "idGrupoEmpresa" => $idGrupoEmpresa,
                "contactoEmpresarial" => [
                    "idContacto" => (int)$data['idContacto'],
                    "codigoTipoIdentificacion" => null,
                    "numeroIdentificacion" => null,
                    "nombre" => $data['personaContacto'],
                    "codigoPaisCelular" => (int)$data['telefonoMovilContactoCode'],
                    "telefonoMovil" => $data['telefonoMovilContacto'],
                    "codigoPaisFijo" => $data['telefonoFijoContactoCode'],
                    "telefonoFijo" => $data['telefonoFijoContacto'],
                    "mail" => strtolower($data['correoContacto']),
                    "cargo" => $data['cargoPersonaContacto']
                ]
            ]
        ];

        $esGrupoEmpresa = "false";
        if ($request->has('esGrupoEmpresa')) {
            $esGrupoEmpresa = "true";
        }
        $method = '/comercial/v1/clientes/'.$data['codigoCliente'];
        $param = '';

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            'token'    => Session::get('accessToken'),
            'data'     => $cliente,
            'method'   => 'PUT'
        ]);
        // print_r(json_encode($cliente));
        // echo Ism::BASE_URL.$method.$param;
        // dump($cliente);
        // dd($response);

        if($response->code != 200){
            session()->flash('mensaje', $response->message);
            return redirect()->back()->withErrors($request->all())->withInput();
        }else{
            session()->flash('success', "Cliente modificado exitosamente");
            return redirect()->route('consulta-clientes');
            //return view('cotizador.clientes');
        }
        
    }
}
