<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroInstalacionController;

Route::get('/', function () {
    return view('dashboard');
});

// REGISTROS
Route::get('/registros', [RegistroInstalacionController::class, 'index'])->name('registros.index');
Route::get('/registros/create', [RegistroInstalacionController::class, 'create'])->name('registros.create');
Route::post('/registros', [RegistroInstalacionController::class, 'store'])->name('registros.store');

// CLIENTES
Route::get('/clientes', [RegistroInstalacionController::class, 'create'])->name('clientes.create');
Route::get('/clientes/listado', [RegistroInstalacionController::class, 'index'])->name('clientes.index');

// AJAX
Route::get('/buscar-serial/{serial}', [RegistroInstalacionController::class, 'buscarSerial']);