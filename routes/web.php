<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguridadesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CotizadorController;

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
    
    Route::get('/olvide-clave', [SeguridadesController::class, 'olvideClave'])->name('olvide_clave')->withoutMiddleware(['loggedUser']);
    Route::post('/recuperar-clave', [SeguridadesController::class, 'recuperarClave'])->name('recuperar_clave')->withoutMiddleware(['loggedUser']);
    Route::get('/reestablecer-clave', [SeguridadesController::class, 'reestablecerClave'])->name('reestablecer_clave')->withoutMiddleware(['loggedUser']);

    Route::get('/cotizacion', function () {
        return view('cotizador.cotizacion');
    })->withoutMiddleware(['loggedUser']);
});

//Route::middleware('auth')->group(function () {
Route::group(['middleware' => ['loggedUser']], function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home')->withoutMiddleware(['guest']);

    Route::get('/logout', [SeguridadesController::class, 'logout'])->name('logout')->withoutMiddleware(['guest']);
    
    /*Cotizador*/
    Route::prefix('cotizador')->group(function () {
        Route::get('/registro-clientes', [CotizadorController::class, 'registroCliente'])->name('registro-clientes')->withoutMiddleware(['guest']);
        
        Route::get('/cotizador/{numeroIdentificacion?}', [CotizadorController::class, 'cotizador'])->name('cotizador')->withoutMiddleware(['guest']);

        Route::get('/consulta-clientes', [CotizadorController::class, 'clientes'])->name('consulta-clientes')->withoutMiddleware(['guest']);
        
        Route::get('/cliente/edit/{codigoCliente}', [CotizadorController::class, 'obtenerInfoCliente'])->name('consulta-info-cliente')->withoutMiddleware(['guest']);
        
        Route::get('/consulta-cotizaciones', [CotizadorController::class, 'cotizaciones'])->name('consulta-cotizaciones')->withoutMiddleware(['guest']);
        
        Route::post('/crear-cliente', [CotizadorController::class, 'crearCliente'])->name('crear-cliente')->withoutMiddleware(['guest']);

    });

    Route::get('/refreshToken', [SeguridadesController::class, 'refreshToken'])->name('refreshToken')->withoutMiddleware(['guest']);
    
});