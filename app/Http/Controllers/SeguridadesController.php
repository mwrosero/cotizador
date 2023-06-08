<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Ism;

class SeguridadesController extends Controller
{
    /*Login*/
    public function login(){
        $info = Session::get('userData');
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

        if($response->code == 200){
            $method = '/autenticacion/login';

            $response = Ism::call([
                'endpoint'  => Ism::BASE_URL.$method,
                'basic'     => base64_encode(strtoupper($user) .":". $password),
                'method'    => 'POST'
            ]);
            if($response->code == 200){
                switch($response->data->estadoUsuario) {
                    case 'CONFIRMED':
                        Session::put('userData', $response->data);
                        Session::put('accessToken', $response->data->idToken);
                        
                        $method = '/usuarios/'.$response->data->secuenciaUsuario.'/modulos_opciones_acceso';
                        $param = '?codigoSucursal='.Ism::CODIGOSUCURSAL;

                        $response = Ism::call([
                            'endpoint' => Ism::BASE_URL.$method.$param,
                            'token'    => $response->data->idToken,
                            'method'   => 'GET'
                        ]);

                        Session::put('menu', $response->data);
                        return redirect('/');
                    break;
                    case 'FORCE_CHANGE_PASSWORD':
                        $message = "Usuario nuevo que ingresa una clave temporal";
                    break;
                    case 'CHANGE_PASSWORD':
                        $message = "Usuario debe cambiar su clave porque ha pasado 'x' tiempo desde el último cambio";
                    break;
                    case 'RESET_REQUIRED':
                        $message = "Usuario importado debe seguir el flujo de recuperar contraseña";
                    break;
                }
            }else{
                $message = $response->message;
            }
        }else{
            $message = $response->message;
        }
        if(isset($message)){
            session()->flash('mensaje', $message);
            session()->flash('user', strtoupper($user));
            return redirect('/login');
        }
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
