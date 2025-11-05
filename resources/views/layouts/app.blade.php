<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema Restaurante')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🍽️ Restaurante</a>
            <div>
                <a href="{{ url('/clientes') }}" class="nav-link d-inline text-white">Clientes</a>
                <a href="{{ url('/pratos') }}" class="nav-link d-inline text-white">Pratos</a>
                <a href="{{ url('/encomendas') }}" class="nav-link d-inline text-white">Encomendas</a>
                <a href="{{ url('/relatorio/encomendas') }}" class="nav-link d-inline text-white">Relatórios</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
