<?php

use Illuminate\Support\Facades\Route;

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
