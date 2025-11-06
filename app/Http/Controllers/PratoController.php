<?php

namespace App\Http\Controllers;

use App\Models\{Prato, Ingrediente};
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'preco' => 'required|numeric',
            'ingredientes' => 'array',
            'quantidades' => 'array'
        ]);

        $prato = Prato::create($data);

        if ($request->ingredientes) {
            foreach ($request->ingredientes as $key => $idIngrediente) {
                $prato->ingredientes()->attach($idIngrediente, [
                    'quantidade' => $request->quantidades[$key]
                ]);
            }
        }

        return redirect()->route('pratos.index')->with('success', 'Prato criado com sucesso!');
    }
}

