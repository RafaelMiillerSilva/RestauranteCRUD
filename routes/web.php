<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ClienteController, PratoController, IngredienteController, EncomendaController, CompraController};

Route::resource('clientes', ClienteController::class);
Route::resource('pratos', PratoController::class);
Route::resource('ingredientes', IngredienteController::class);
Route::resource('encomendas', EncomendaController::class);
Route::resource('compras', CompraController::class);
