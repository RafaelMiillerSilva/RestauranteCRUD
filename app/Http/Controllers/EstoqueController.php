<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = Estoque::with('ingrediente')->paginate(10);
        return view('estoque.index', compact('estoques'));
    }

    public function create()
    {
        $ingredientes = Ingrediente::all();
        return view('estoque.form', compact('ingredientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingrediente_id' => 'required|exists:ingredientes,id|unique:estoques,ingrediente_id',
            'quantidade' => 'required|numeric|min:0',
        ]);

        Estoque::create($request->all());

        return redirect()->route('estoque.index')->with('success', 'Estoque criado com sucesso!');
    }

    public function edit(Estoque $estoque)
    {
        $ingredientes = Ingrediente::all();
        return view('estoque.form', compact('estoque', 'ingredientes'));
    }

    public function update(Request $request, Estoque $estoque)
    {
        $request->validate([
            'ingrediente_id' => 'required|exists:ingredientes,id|unique:estoques,ingrediente_id,' . $estoque->id,
            'quantidade' => 'required|numeric|min:0',
        ]);

        $estoque->update($request->all());

        return redirect()->route('estoque.index')->with('success', 'Estoque atualizado!');
    }

    public function destroy(Estoque $estoque)
    {
        $estoque->delete();
        return redirect()->route('estoque.index')->with('success', 'Estoque excluído!');
    }
}
