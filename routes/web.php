<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
use App\Http\Controllers\RegistroInstalacionController;

Route::get('/registros/create', [RegistroInstalacionController::class, 'create'])->name('registros.create');
Route::post('/registros', [RegistroInstalacionController::class, 'store'])->name('registros.store');
Route::get('/registros', [RegistroInstalacionController::class, 'index'])->name('registros.index');