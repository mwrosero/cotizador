<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguridadesController;
use App\Http\Controllers\DashboardController;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [SeguridadesController::class, 'login'])->name('login')->withoutMiddleware(['loggedUser']);
    Route::post('/autenticar', [SeguridadesController::class, 'autenticar'])->name('autenticar')->withoutMiddleware(['loggedUser']);
    
    Route::get('/olvide-clave', [SeguridadesController::class, 'olvide_clave'])->name('olvide_clave')->withoutMiddleware(['loggedUser']);
    Route::get('/recuperar-clave', [SeguridadesController::class, 'recuperar_clave'])->name('recuperar_clave')->withoutMiddleware(['loggedUser']);

    Route::get('/cotizacion', function () {
        return view('cotizador.cotizacion');
    })->withoutMiddleware(['loggedUser']);
});

//Route::middleware('auth')->group(function () {
Route::group(['middleware' => ['loggedUser']], function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home')->withoutMiddleware(['guest']);

    Route::get('/logout', [SeguridadesController::class, 'logout'])->name('logout')->withoutMiddleware(['guest']);

    Route::get('/registro-clientes', function () {
        return view('registro');
    })->withoutMiddleware(['guest']);

    Route::get('/cotizador', function () {
        return view('cotizador.cotizacion');
    })->withoutMiddleware(['guest']);

    Route::get('/consulta-clientes', function () {
        return view('mis-clientes');
    })->withoutMiddleware(['guest']);

    Route::get('/consulta-cotizaciones', function () {
        return view('mis-cotizacion');
    })->withoutMiddleware(['guest']);
});