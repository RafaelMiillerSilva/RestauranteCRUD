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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        html, body { 
            height: 100%; 
            width: 100%;
            overflow: hidden;
        }
        
        body { 
            background-color: #f5f6fa; 
            display: flex;
        }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e1e2f;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            padding: 20px 0;
        }
        
        .sidebar h3 {
            text-align: center;
            padding: 15px 20px;
            border-bottom: 1px solid #34344e;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 0 10px 5px 10px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .sidebar a:hover, .sidebar a.active {
            background-color: #34344e;
            padding-left: 25px;
        }
        
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            height: 100vh;
            overflow-y: auto;
            padding: 25px;
        }
        
        .content-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .kpi-card {
            border-radius: 10px;
            color: #fff;
            padding: 20px;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        thead.table-dark {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .pagination {
            margin-top: 15px;
            justify-content: center;
        }

        /* Scrollbar customizado */
        .content::-webkit-scrollbar {
            width: 8px;
        }

        .content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .content::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .content {
                margin-left: 200px;
                width: calc(100% - 200px);
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <h3>Gestao</h3>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">Clientes</a>
        <a href="{{ route('pratos.index') }}" class="{{ request()->routeIs('pratos.*') ? 'active' : '' }}">Pratos</a>
        <a href="{{ route('ingredientes.index') }}" class="{{ request()->routeIs('ingredientes.*') ? 'active' : '' }}">Ingredientes</a>
        <a href="{{ route('estoque.index') }}" class="{{ request()->routeIs('estoque.*') ? 'active' : '' }}">Estoque</a>
        <a href="{{ route('encomendas.index') }}" class="{{ request()->routeIs('encomendas.*') ? 'active' : '' }}">Encomendas</a>
        <a href="{{ route('compras.index') }}" class="{{ request()->routeIs('compras.*') ? 'active' : '' }}">Compras</a>
    </div>

    <!-- Conteudo -->
    <div class="content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
