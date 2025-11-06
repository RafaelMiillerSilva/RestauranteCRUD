<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prato;
use App\Models\Ingrediente;

class PratoController extends Controller
{
    public function index()
    {
        $pratos = Prato::with('ingredientes')->get();
        return view('pratos.index', compact('pratos'));
    }

    public function create()
    {
        $ingredientes = Ingrediente::all();
        return view('pratos.create', compact('ingredientes'));
    }

    public function store(Request $request)
    {
        $prato = Prato::create($request->only(['nome', 'descricao', 'preco']));

        // Vincula os ingredientes
        $ingredientes = $request->input('ingredientes', []);
        $quantidades = $request->input('quantidades', []);
        $syncData = [];
        foreach ($ingredientes as $index => $id) {
            if($id) $syncData[$id] = ['quantidade' => $quantidades[$index] ?? 0];
        }
        $prato->ingredientes()->sync($syncData);

        return redirect()->route('pratos.index')->with('success', 'Prato criado!');
    }

    public function edit(Prato $prato)
    {
        $ingredientes = Ingrediente::all();
        $prato->load('ingredientes');
        return view('pratos.edit', compact('prato', 'ingredientes'));
    }

    public function update(Request $request, Prato $prato)
    {
        $prato->update($request->only(['nome', 'descricao', 'preco']));

        $ingredientes = $request->input('ingredientes', []);
        $quantidades = $request->input('quantidades', []);
        $syncData = [];
        foreach ($ingredientes as $index => $id) {
            if($id) $syncData[$id] = ['quantidade' => $quantidades[$index] ?? 0];
        }
        $prato->ingredientes()->sync($syncData);

        return redirect()->route('pratos.index')->with('success', 'Prato atualizado!');
    }

    public function destroy(Prato $prato)
    {
        $prato->ingredientes()->detach();
        $prato->delete();
        return redirect()->route('pratos.index')->with('success', 'Prato removido!');
    }
}

