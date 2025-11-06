@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Restaurante')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- MENU LATERAL -->
        <div class="col-md-2 bg-dark text-white vh-100 p-3">
            <h4 class="text-center mb-4">🍽 Restaurante</h4>
            <a href="{{ route('dashboard') }}" class="d-block text-white mb-2">🏠 Dashboard</a>
            <a href="{{ route('clientes.index') }}" class="d-block text-white mb-2">👤 Clientes</a>
            <a href="{{ route('pratos.index') }}" class="d-block text-white mb-2">🍲 Pratos</a>
            <a href="{{ route('ingredientes.index') }}" class="d-block text-white mb-2">🥦 Ingredientes</a>
            <a href="{{ route('encomendas.index') }}" class="d-block text-white mb-2">🧾 Encomendas</a>
            <a href="{{ route('compras.index') }}" class="d-block text-white mb-2">🛒 Compras</a>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Dashboard de Gestão</h2>

            <!-- KPI CARDS -->
            <div class="row text-white mb-4">
                <div class="col-md-2">
                    <div class="card bg-success shadow">
                        <div class="card-body">
                            <h6>Vendas</h6>
                            <h4>R$ 45.230,00</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-warning shadow">
                        <div class="card-body">
                            <h6>A Receber</h6>
                            <h4>R$ 8.450,00</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-danger shadow">
                        <div class="card-body">
                            <h6>A Pagar</h6>
                            <h4>R$ 3.200,00</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-primary shadow">
                        <div class="card-body">
                            <h6>Clientes</h6>
                            <h4>128</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-info shadow">
                        <div class="card-body">
                            <h6>Estoque</h6>
                            <h4>R$ 12.780,00</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-secondary shadow">
                        <div class="card-body">
                            <h6>Pratos</h6>
                            <h4>32</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRÁFICOS -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Crescimento de Vendas</h5>
                            <canvas id="graficoVendas"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Vendas por Grupo</h5>
                            <canvas id="graficoGrupos"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Receitas e Despesas do Mês</h5>
                            <canvas id="graficoFinanceiro"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>Despesas</h5>
                            <canvas id="graficoDespesas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx1 = document.getElementById('graficoVendas');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
        datasets: [{ label: 'Vendas', data: [12000, 18000, 14000, 22000, 26000] }]
    }
});

const ctx2 = document.getElementById('graficoGrupos');
new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Massas', 'Carnes', 'Sobremesas'],
        datasets: [{ data: [40, 35, 25] }]
    }
});

const ctx3 = document.getElementById('graficoFinanceiro');
new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['Receitas', 'Despesas'],
        datasets: [{ data: [30000, 15000], backgroundColor: ['#198754', '#dc3545'] }]
    }
});

const ctx4 = document.getElementById('graficoDespesas');
new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: ['Ingredientes', 'Funcionários', 'Energia', 'Outros'],
        datasets: [{ data: [50, 25, 15, 10] }]
    }
});
</script>
@endsection
