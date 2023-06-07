<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Ism;

class SeguridadesController extends Controller
{
    /*Login*/
    public function login(){
        return view('login.login');
    }

    public function autenticar(Request $request){
        $data = $request->all();
        $user = $data['user'];
        $password = $data['password'];

        $method = '/usuarios/verificacion_cuenta';
        $param = '?usuario='.strtoupper($user);

        $response = Ism::call([
            'endpoint' => Ism::BASE_URL.$method.$param,
            //'token'    => Ism::getToken(),
            //'data'     => ['' => $var],
            'method'   => 'GET'
        ]);

        echo Ism::BASE_URL.$method.$param;
        dd($response);

        return view('login.login');
    }

    /*Login*/
    public function olvide_clave(){
        return view('login.olvide_clave');
    }

    /*Login*/
    public function recuperar_clave(){
        return view('login.recuperar_clave');
    }

    /*Logout*/
    public function miFuncion(){
        // Session::forget('user');
        Session::flush();
    }
}
