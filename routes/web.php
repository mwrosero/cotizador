<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguridadesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/cotizacion', function () {
    return view('cotizacion');
});

Route::get('/mis-clientes', function () {
    return view('mis-clientes');
});

Route::get('/mis-cotizacion', function () {
    return view('mis-cotizacion');
});

Route::get('/login', function () {
    return view('login.login');
});

Route::get('/olvidecontrasena', function () {
    return view('login.olvidecontrasena');
});

Route::get('/recuperar-contrasena', function () {
    return view('login.recuperar-contrasena');
});