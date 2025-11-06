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
        $request->validate([
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

                // desconta do estoque
                foreach ($prato->ingredientes as $ingrediente) {
                    $qtdNecessaria = $ingrediente->pivot->quantidade * $quantidade;
                    $estoque = Estoque::where('ingrediente_id', $ingrediente->id)->first();
                    if ($estoque) {
                        $estoque->quantidade_atual -= $qtdNecessaria;
                        if ($estoque->quantidade_atual < 0) $estoque->quantidade_atual = 0;
                        $estoque->save();
                    }
                }
            }

            $encomenda->update(['valor_total' => $valorTotal]);
        });

        return redirect()->route('encomendas.index')->with('success', 'Encomenda criada e estoque atualizado!');
    }

    public function edit(Encomenda $encomenda)
    {
        $clientes = Cliente::all();
        $pratos = Prato::all();
        $encomenda->load('itens');
        return view('encomendas.edit', compact('encomenda', 'clientes', 'pratos'));
    }

    public function update(Request $request, Encomenda $encomenda)
    {
        $request->validate([
            'cliente_id' => 'required',
            'pratos' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $encomenda) {
            // restaura o estoque dos itens antigos
            foreach ($encomenda->itens as $item) {
                $prato = Prato::with('ingredientes')->find($item->prato_id);
                foreach ($prato->ingredientes as $ingrediente) {
                    $qtdUsada = $ingrediente->pivot->quantidade * $item->quantidade;
                    $estoque = Estoque::where('ingrediente_id', $ingrediente->id)->first();
                    if ($estoque) {
                        $estoque->quantidade_atual += $qtdUsada;
                        $estoque->save();
                    }
                }
            }

            // remove os itens antigos
            $encomenda->itens()->delete();

            // adiciona novos itens e atualiza estoque
            $valorTotal = 0;
            foreach ($request->pratos as $i => $pratoId) {
                $prato = Prato::with('ingredientes')->findOrFail($pratoId);
                $quantidade = (int)$request->quantidades[$i];
                $preco = $prato->preco;

                $encomenda->itens()->create([
                    'prato_id' => $pratoId,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $preco
                ]);

                $valorTotal += $preco * $quantidade;

                foreach ($prato->ingredientes as $ingrediente) {
                    $qtdNecessaria = $ingrediente->pivot->quantidade * $quantidade;
                    $estoque = Estoque::where('ingrediente_id', $ingrediente->id)->first();
                    if ($estoque) {
                        $estoque->quantidade_atual -= $qtdNecessaria;
                        if ($estoque->quantidade_atual < 0) $estoque->quantidade_atual = 0;
                        $estoque->save();
                    }
                }
            }

            $encomenda->update([
                'cliente_id' => $request->cliente_id,
                'valor_total' => $valorTotal
            ]);
        });

        return redirect()->route('encomendas.index')->with('success', 'Encomenda atualizada com sucesso!');
    }

    public function destroy(Encomenda $encomenda)
    {
        DB::transaction(function () use ($encomenda) {
            // restaura estoque
            foreach ($encomenda->itens as $item) {
                $prato = Prato::with('ingredientes')->find($item->prato_id);
                foreach ($prato->ingredientes as $ingrediente) {
                    $qtdUsada = $ingrediente->pivot->quantidade * $item->quantidade;
                    $estoque = Estoque::where('ingrediente_id', $ingrediente->id)->first();
                    if ($estoque) {
                        $estoque->quantidade_atual += $qtdUsada;
                        $estoque->save();
                    }
                }
            }

            $encomenda->itens()->delete();
            $encomenda->delete();
        });

        return redirect()->route('encomendas.index')->with('success', 'Encomenda excluída e estoque restaurado!');
    }

    public function toggleStatus(Encomenda $encomenda)
{
    $encomenda->status = $encomenda->status === 'pago' ? 'pendente' : 'pago';
    $encomenda->save();

    return response()->json(['success' => true]);
}

}
