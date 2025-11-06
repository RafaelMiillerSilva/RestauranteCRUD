@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📦 Encomendas</h2>
        <a href="{{ route('encomendas.create') }}" class="btn btn-success">+ Nova Encomenda</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Valor Total (R$)</th>
                <th>Status</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($encomendas as $encomenda)
            <tr>
                <td>{{ $encomenda->id }}</td>
                <td>{{ $encomenda->cliente->nome }}</td>
                <td>{{ \Carbon\Carbon::parse($encomenda->data)->format('d/m/Y H:i') }}</td>
                <td>{{ number_format($encomenda->valor_total, 2, ',', '.') }}</td>
                <td>{{ $encomenda->status ?? 'Pendente' }}</td>
                <td class="text-end">
                    <a href="{{ route('encomendas.edit', $encomenda) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                    <form action="{{ route('encomendas.destroy', $encomenda) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir esta encomenda?')">🗑️ Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
