document.addEventListener("DOMContentLoaded", () => {
    const data = window.dashboardData || {};

    const safeArray = (arr) => Array.isArray(arr) ? arr : [];

    // --- GRÁFICO: Vendas por mês ---
    const ctxVendas = document.getElementById('graficoVendas');
    if (ctxVendas) {
        console.log("DADOS RECEBIDOS PELO JS ctxVendas:", window.dashboardData);
        new Chart(ctxVendas, {
            type: 'bar',
            data: {
                labels: safeArray(data.graficoVendas?.labels),
                datasets: [{
                    label: 'Vendas (R$)',
                    data: safeArray(data.graficoVendas?.data),
                    backgroundColor: '#0d6efd'
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    }

    // --- GRÁFICO: Pratos mais vendidos ---
    const ctxGrupos = document.getElementById('graficoGrupos');
    if (ctxGrupos) {
        console.log("DADOS RECEBIDOS PELO JS ctxGrupos:", window.dashboardData);
        new Chart(ctxGrupos, {
            type: 'pie',
            data: {
                labels: safeArray(data.graficoGrupos?.labels),
                datasets: [{
                    data: safeArray(data.graficoGrupos?.data),
                    backgroundColor: ['#198754','#0dcaf0','#ffc107','#dc3545','#6c757d']
                }]
            },
            options: { responsive: true }
        });
    }

    // --- GRÁFICO: Receitas x Despesas ---
    const ctxReceitasDespesas = document.getElementById('graficoReceitasDespesas');
    if (ctxReceitasDespesas) {
        console.log("DADOS RECEBIDOS PELO JS ctxReceitasDespesas:", window.dashboardData);
        new Chart(ctxReceitasDespesas, {
            type: 'bar',
            data: {
                labels: safeArray(data.graficoReceitasDespesas?.labels),
                datasets: [
                    { label: 'Receitas', data: safeArray(data.graficoReceitasDespesas?.receitas), backgroundColor: '#198754' },
                    { label: 'Despesas', data: safeArray(data.graficoReceitasDespesas?.despesas), backgroundColor: '#dc3545' }
                ]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
    }

    // --- GRÁFICO: Despesas por fornecedor ---
    const ctxDespesas = document.getElementById('graficoDespesas');
    if (ctxDespesas) {
        console.log("DADOS RECEBIDOS PELO JS ctxDespesas:", window.dashboardData);
        new Chart(ctxDespesas, {
            type: 'pie',
            data: {
                labels: safeArray(data.graficoDespesas?.labels),
                datasets: [{
                    data: safeArray(data.graficoDespesas?.data),
                    backgroundColor: ['#dc3545','#ffc107','#0d6efd','#6c757d','#198754']
                }]
            },
            options: { responsive: true }
        });
    }
});
