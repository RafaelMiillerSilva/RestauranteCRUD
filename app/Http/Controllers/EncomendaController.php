<?php

namespace App\Http\Controllers;

use App\Models\{Encomenda, EncomendaItem, Cliente, Prato, Estoque};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EncomendaController extends Controller
{
    public function index()
    {
        $encomendas = Encomenda::with('cliente')->get();
        return view('encomendas.index', compact('encomendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $pratos = Prato::all();
        return view('encomendas.create', compact('clientes', 'pratos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required',
            'pratos' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {

            $encomenda = Encomenda::create([
                'cliente_id' => $request->cliente_id,
                'data' => now(),
                'valor_total' => 0
            ]);

            $valorTotal = 0;

            foreach ($request->pratos as $i => $pratoId) {
                $prato = Prato::with('ingredientes')->findOrFail($pratoId);
                $quantidade = (int)$request->quantidades[$i];
                $preco = $prato->preco;

                // cria item da encomenda
                $encomenda->itens()->create([
                    'prato_id' => $pratoId,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $preco
                ]);

                $valorTotal += $preco * $quantidade;

                // desconta do estoque os ingredientes usados neste prato
                foreach ($prato->ingredientes as $ingrediente) {
                    $qtdNecessaria = $ingrediente->pivot->quantidade * $quantidade;

                    $estoque = Estoque::where('ingrediente_id', $ingrediente->id)->first();

                    if ($estoque) {
                        $estoque->quantidade_atual -= $qtdNecessaria;
                        if ($estoque->quantidade_atual < 0) {
                            $estoque->quantidade_atual = 0; // evita negativo
                        }
                        $estoque->save();
                    }
                }
            }

            $encomenda->update(['valor_total' => $valorTotal]);
        });

        return redirect()->route('encomendas.index')->with('success', 'Encomenda criada e estoque atualizado!');
    }
}

