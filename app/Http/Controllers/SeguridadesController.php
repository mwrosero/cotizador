<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SeguridadesController extends Controller
{
    /*Login*/
    public function login(){
        return response('Mi respuesta');
    }

    /*Logout*/
    public function miFuncion(){
        // Session::forget('user');
        Session::flush();
    }
}
