<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ClienteController,
    PratoController,
    IngredienteController,
    EstoqueController,
    EncomendaController,
    ComprasController
};

// Redirecionamento raiz
Route::get('/', fn() => redirect()->route('dashboard'));

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Recursos CRUD
Route::resource('clientes', ClienteController::class);
Route::resource('pratos', PratoController::class);
Route::resource('ingredientes', IngredienteController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('compras', ComprasController::class);

// ------------------------------
// Encomendas
// ------------------------------

// Rotas CRUD padrão
Route::resource('encomendas', EncomendaController::class);

// Rota custom para atualizar o status via checkbox
Route::patch('/encomendas/{encomenda}/status', [EncomendaController::class, 'toggleStatus'])
    ->name('encomendas.toggleStatus');

