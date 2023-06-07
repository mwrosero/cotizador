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

Route::get('/', function () {
    return view('welcome');
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [SeguridadesController::class, 'login'])->name('login');
    Route::get('/olvide-clave', [SeguridadesController::class, 'login'])->name('olvide-clave');
    Route::get('/recuperar-clave', [SeguridadesController::class, 'login'])->name('recuperar-clave');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [NombreDelControlador::class, 'nombreDelMetodo'])->name('admin');
    Route::get('/clientes', [NombreDelControlador::class, 'nombreDelMetodo'])->name('clientes');
    Route::get('/logout', [SeguridadesController::class, 'logout'])->name('logout');
});
