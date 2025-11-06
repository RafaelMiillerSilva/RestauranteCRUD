<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Prato;

class DashboardController extends Controller
{
    public function index()
    {
        // ------------------------
        // Indicadores gerais
        // ------------------------
        $totalClientes = Cliente::count();
        $totalPratos = Prato::count();

        $totalVendas = DB::table('encomendas')->where('status', 'pago')->sum('valor_total');
        $aReceber = DB::table('encomendas')->where('status', 'pendente')->sum('valor_total');
        $aPagar = DB::table('compras')->where('status', 'pendente')->sum('valor_total');

        // Valor total de estoque
        $valorEstoque = DB::table('ingredientes')
            ->join('estoques', 'ingredientes.id', '=', 'estoques.ingrediente_id')
            ->sum(DB::raw('ingredientes.preco * estoques.quantidade'));

        // ------------------------
        // GRÁFICOS
        // ------------------------

        // 📈 Vendas por mês (últimos 6 meses)
        $graficoVendasRaw = DB::table('encomendas')
            ->select(
                DB::raw("DATE_FORMAT(data, '%m/%Y') as mes"),
                DB::raw('SUM(valor_total) as total')
            )
            ->groupBy('mes')
            ->orderBy(DB::raw("MIN(data)"))
            ->limit(6)
            ->get();

        $graficoVendas = [
            'labels' => $graficoVendasRaw->pluck('mes')->toArray(),
            'data' => $graficoVendasRaw->pluck('total')->toArray()
        ];

        // 🍲 Pratos mais vendidos
        $graficoGruposRaw = DB::table('encomenda_prato')
            ->join('pratos', 'encomenda_prato.prato_id', '=', 'pratos.id')
            ->select('pratos.nome as prato', DB::raw('SUM(encomenda_prato.quantidade) as total'))
            ->groupBy('pratos.nome')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $graficoGrupos = [
            'labels' => $graficoGruposRaw->pluck('prato')->toArray(),
            'data' => $graficoGruposRaw->pluck('total')->toArray()
        ];

        // 💰 Receitas x Despesas por mês
        $vendasMensaisRaw = DB::table('encomendas')
            ->select(DB::raw("DATE_FORMAT(data, '%m/%Y') as mes"), DB::raw('SUM(valor_total) as total'))
            ->groupBy('mes')
            ->get();

        $comprasMensaisRaw = DB::table('compras')
            ->select(DB::raw("DATE_FORMAT(data_compra, '%m/%Y') as mes"), DB::raw('SUM(valor_total) as total'))
            ->groupBy('mes')
            ->get();

        $meses = collect($vendasMensaisRaw->pluck('mes'))
            ->merge($comprasMensaisRaw->pluck('mes'))
            ->unique()
            ->values()
            ->toArray();

        $receitas = [];
        $despesas = [];
        foreach ($meses as $mes) {
            $receitas[] = $vendasMensaisRaw->firstWhere('mes', $mes)->total ?? 0;
            $despesas[] = $comprasMensaisRaw->firstWhere('mes', $mes)->total ?? 0;
        }

        $graficoReceitasDespesas = [
            'labels' => $meses,
            'receitas' => $receitas,
            'despesas' => $despesas
        ];

        // 💸 Despesas por fornecedor
        $graficoDespesasRaw = DB::table('compras')
            ->select('fornecedor', DB::raw('SUM(valor_total) as total'))
            ->groupBy('fornecedor')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $graficoDespesas = [
            'labels' => $graficoDespesasRaw->pluck('fornecedor')->toArray(),
            'data' => $graficoDespesasRaw->pluck('total')->toArray()
        ];

        // ------------------------
        // Retorno para a view
        // ------------------------
        return view('dashboard.index', [
            'totalClientes' => $totalClientes,
            'totalPratos' => $totalPratos,
            'valorEstoque' => $valorEstoque,
            'totalVendas' => $totalVendas,
            'aReceber' => $aReceber,
            'aPagar' => $aPagar,
            'graficoVendas' => $graficoVendas,
            'graficoGrupos' => $graficoGrupos,
            'graficoReceitasDespesas' => $graficoReceitasDespesas,
            'graficoDespesas' => $graficoDespesas
        ]);
    }
}
