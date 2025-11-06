@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">📊 Painel de Controle</h2>

    <!-- KPIs -->
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="kpi-card bg-primary text-center">
                <h5>Vendas</h5>
                <h3>R$ 12.350</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-success text-center">
                <h5>A Receber</h5>
                <h3>R$ 3.200</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-danger text-center">
                <h5>A Pagar</h5>
                <h3>R$ 1.850</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-warning text-center">
                <h5>Clientes</h5>
                <h3>127</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-info text-center">
                <h5>Estoque</h5>
                <h3>R$ 9.450</h3>
            </div>
        </div>
        <div class="col-md-2">
            <div class="kpi-card bg-secondary text-center">
                <h5>Pratos</h5>
                <h3>45</h3>
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
                <div class="card-header bg-success text-white">Vendas por Grupo</div>
                <div class="card-body">
                    <canvas id="graficoGrupos"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">Receitas x Despesas do Mês</div>
                <div class="card-body">
                    <canvas id="graficoReceitasDespesas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">Despesas</div>
                <div class="card-body">
                    <canvas id="graficoDespesas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx1 = document.getElementById('graficoVendas');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{ label: 'Vendas (R$)', data: [1200, 1800, 1400, 2000, 2500, 2300], backgroundColor: '#0d6efd' }]
        }
    });

    const ctx2 = document.getElementById('graficoGrupos');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Bebidas', 'Massas', 'Carnes', 'Sobremesas'],
            datasets: [{ data: [25, 35, 20, 20], backgroundColor: ['#198754','#0dcaf0','#ffc107','#dc3545'] }]
        }
    });

    const ctx3 = document.getElementById('graficoReceitasDespesas');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [
                { label: 'Receitas', data: [2000, 2400, 2600, 2800, 3200, 3100], backgroundColor: '#198754' },
                { label: 'Despesas', data: [1500, 1800, 1900, 2200, 2100, 2300], backgroundColor: '#dc3545' }
            ]
        }
    });

    const ctx4 = document.getElementById('graficoDespesas');
    new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: ['Ingredientes', 'Energia', 'Funcionários', 'Outros'],
            datasets: [{ data: [40, 25, 20, 15], backgroundColor: ['#dc3545','#ffc107','#0d6efd','#6c757d'] }]
        }
    });
</script>
@endsection
