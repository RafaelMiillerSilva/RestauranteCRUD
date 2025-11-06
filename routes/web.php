<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ClienteController,
    PratoController,
    IngredienteController,
    EncomendaController,
    CompraController
};

Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('clientes', ClienteController::class);
Route::resource('pratos', PratoController::class);
Route::resource('ingredientes', IngredienteController::class);
Route::resource('encomendas', EncomendaController::class);
Route::resource('compras', CompraController::class);

