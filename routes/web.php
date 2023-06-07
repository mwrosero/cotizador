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

<<<<<<< HEAD
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/registro', function () {
    return view('cotizador.registro');
});

Route::get('/cotizacion', function () {
    return view('cotizador.cotizacion');
});

Route::get('/clientes', function () {
    return view('cotizador.clientes');
});

Route::get('/cotizaciones', function () {
    return view('cotizador.cotizaciones');
});

=======
/*
>>>>>>> developer
Route::get('/login', function () {
    return view('login.login');
});

Route::get('/olvidecontrasena', function () {
    return view('login.olvidecontrasena');
});

Route::get('/recuperar-contrasena', function () {
    return view('login.recuperar-contrasena');
});*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [SeguridadesController::class, 'login'])->name('login');
    Route::post('/autenticar', [SeguridadesController::class, 'autenticar'])->name('autenticar');
    
    Route::get('/olvide-clave', [SeguridadesController::class, 'olvide_clave'])->name('olvide_clave');
    Route::get('/recuperar-clave', [SeguridadesController::class, 'recuperar_clave'])->name('recuperar_clave');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [SeguridadesController::class, 'login'])->name('login');
    Route::get('/admin', [NombreDelControlador::class, 'nombreDelMetodo'])->name('admin');
    Route::get('/clientes', [NombreDelControlador::class, 'nombreDelMetodo'])->name('clientes');
    Route::get('/logout', [SeguridadesController::class, 'logout'])->name('logout');

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
});