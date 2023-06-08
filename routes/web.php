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
    Route::get('/', [DashboardController::class, 'home'])->name('home')->withoutMiddleware(['guest']);;

    Route::get('/logout', [SeguridadesController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/registro', function () {
        return view('registro');
    });

    Route::get('/cotizacion', function () {
        return view('cotizador.cotizacion');
    });

    Route::get('/mis-clientes', function () {
        return view('mis-clientes');
    });

    Route::get('/mis-cotizacion', function () {
        return view('mis-cotizacion');
    });
});