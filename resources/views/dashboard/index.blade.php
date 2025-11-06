@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">📊 Painel de Controle</h2>

    <!-- KPIs -->
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="kpi-card bg-primary text-center text-white p-3 rounded">
                <h5>Vendas</h5>
                <h3>R$ {{ number_format($totalVendas, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-success text-center text-white p-3 rounded">
                <h5>A Receber</h5>
                <h3>R$ {{ number_format($aReceber, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-danger text-center text-white p-3 rounded">
                <h5>A Pagar</h5>
                <h3>R$ {{ number_format($aPagar, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-warning text-center text-dark p-3 rounded">
                <h5>Clientes</h5>
                <h3>{{ $totalClientes }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-info text-center text-white p-3 rounded">
                <h5>Estoque</h5>
                <h3>R$ {{ number_format($valorEstoque, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-secondary text-center text-white p-3 rounded">
                <h5>Pratos</h5>
                <h3>{{ $totalPratos }}</h3>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Crescimento de Vendas</div>
                <div class="card-body">
                    <canvas id="graficoVendas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Pratos Mais Vendidos</div>
                <div class="card-body">
                    <canvas id="graficoGrupos"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">Receitas x Despesas</div>
                <div class="card-body">
                    <canvas id="graficoReceitasDespesas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">Despesas por Fornecedor</div>
                <div class="card-body">
                    <canvas id="graficoDespesas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Passa os dados PHP para o JavaScript --}}
<script>
    window.dashboardData = {
        graficoVendas: @json($graficoVendas),
        graficoGrupos: @json($graficoGrupos),
        graficoReceitasDespesas: @json($graficoReceitasDespesas),
        graficoDespesas: @json($graficoDespesas)
    };
</script>

{{-- Importa Chart.js se ainda não estiver no layout --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Carrega o script do dashboard --}}
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
