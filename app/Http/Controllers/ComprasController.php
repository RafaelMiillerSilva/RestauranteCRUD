<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function index()
    {
        $compras = Compra::paginate(10);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        return view('compras.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nota_fiscal' => 'required|string|unique:compras',
            'fornecedor' => 'required|string|max:255',
            'data_compra' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'status' => 'required|in:pendente,pago',
        ]);

        Compra::create($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra criada com sucesso!');
    }

    public function edit(Compra $compra)
    {
        return view('compras.form', compact('compra'));
    }

    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'nota_fiscal' => 'required|string|unique:compras,nota_fiscal,' . $compra->id,
            'fornecedor' => 'required|string|max:255',
            'data_compra' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'status' => 'required|in:pendente,pago',
        ]);

        $compra->update($request->all());

        return redirect()->route('compras.index')->with('success', 'Compra atualizada!');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra excluída!');
    }

    public function toggleStatus(Compra $compra)
    {
        $compra->status = $compra->status === 'pago' ? 'pendente' : 'pago';
        $compra->save();

        return response()->json(['success' => true, 'status' => $compra->status]);
    }
}
