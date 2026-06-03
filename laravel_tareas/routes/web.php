<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
Route::post('/tareas/{id}/estado', [TareaController::class, 'actualizarEstado']);

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tareas', TareaController::class);
?>