<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::paginate(10);
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'nullable|string|max:50',
            'preco' => 'required|numeric|min:0',
        ]);

        Ingrediente::create($request->only(['nome', 'unidade_medida', 'preco']));

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente criado com sucesso!');
    }

    public function edit(Ingrediente $ingrediente)
    {
        return view('ingredientes.form', compact('ingrediente'));
    }

    public function update(Request $request, Ingrediente $ingrediente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'nullable|string|max:50',
            'preco' => 'required|numeric|min:0',
        ]);

        $ingrediente->update($request->only(['nome', 'unidade_medida', 'preco']));

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente atualizado!');
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente excluído!');
    }
}
