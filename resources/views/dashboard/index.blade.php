@extends('layouts.app')

@section('content')
<h2 class="mb-3">Painel de Controle</h2>

<!-- KPIs -->
<div class="row g-2 mb-3">
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-primary text-center text-white">
            <h6 class="mb-2">Vendas</h6>
            <h4>R$ {{ number_format($totalVendas, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-success text-center text-white">
            <h6 class="mb-2">A Receber</h6>
            <h4>R$ {{ number_format($aReceber, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-danger text-center text-white">
            <h6 class="mb-2">A Pagar</h6>
            <h4>R$ {{ number_format($aPagar, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-warning text-center text-dark">
            <h6 class="mb-2">Clientes</h6>
            <h4>{{ $totalClientes }}</h4>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-info text-center text-white">
            <h6 class="mb-2">Estoque</h6>
            <h4>R$ {{ number_format($valorEstoque, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="kpi-card bg-secondary text-center text-white">
            <h6 class="mb-2">Pratos</h6>
            <h4>{{ $totalPratos }}</h4>
        </div>
    </div>
</div>

<!-- Graficos -->
<div class="row g-2">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white">Crescimento de Vendas</div>
            <div class="card-body">
                <canvas id="graficoVendas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-success text-white">Pratos Mais Vendidos</div>
            <div class="card-body">
                <canvas id="graficoGrupos"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-warning text-white">Receitas x Despesas</div>
            <div class="card-body">
                <canvas id="graficoReceitasDespesas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-danger text-white">Despesas por Fornecedor</div>
            <div class="card-body">
                <canvas id="graficoDespesas"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    window.dashboardData = {
        graficoVendas: @json($graficoVendas),
        graficoGrupos: @json($graficoGrupos),
        graficoReceitasDespesas: @json($graficoReceitasDespesas),
        graficoDespesas: @json($graficoDespesas)
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
