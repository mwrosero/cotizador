<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Ism;

class DashboardController extends Controller
{
  /*Dashboard Home*/
  public function home(){
    return view('cotizador.cotizacion');
  }
}
