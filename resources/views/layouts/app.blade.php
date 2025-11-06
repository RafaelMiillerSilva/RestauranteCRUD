<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f5f6fa; }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e1e2f;
            color: #fff;
            position: fixed;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #34344e;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .kpi-card {
            border-radius: 10px;
            color: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h3 class="text-center mb-4">🍽️ Gestão</h3>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
        <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">👥 Clientes</a>
        <a href="{{ route('pratos.index') }}" class="{{ request()->routeIs('pratos.*') ? 'active' : '' }}">🍲 Pratos</a>
        <a href="{{ route('ingredientes.index') }}" class="{{ request()->routeIs('ingredientes.*') ? 'active' : '' }}">🥦 Ingredientes</a>
        <a href="{{ route('encomendas.index') }}" class="{{ request()->routeIs('encomendas.*') ? 'active' : '' }}">💰 Encomendas</a>
        <a href="{{ route('compras.index') }}" class="{{ request()->routeIs('compras.*') ? 'active' : '' }}">🧾 Compras</a>
    </div>

    <!-- Conteúdo -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
