<?php

use App\Http\Controllers\EspacioController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return redirect()->route('espacios.index');
});

Route::resource('espacios', EspacioController::class);
Route::resource('reservas', ReservaController::class);