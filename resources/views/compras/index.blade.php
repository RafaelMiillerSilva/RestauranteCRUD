@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Compras</h2>
        <a href="{{ route('compras.create') }}" class="btn btn-primary">+ Nova Compra</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Fornecedor</th>
                <th>Valor Total (R$)</th>
                <th>Status</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->fornecedor }}</td>
                <td>{{ number_format($compra->valor_total, 2, ',', '.') }}</td>
                <td>{{ $compra->status }}</td>
                <td class="text-end">
                    <a href="{{ route('compras.edit', $compra) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                    <form action="{{ route('compras.destroy', $compra) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir compra?')">🗑️ Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $compras->links() }}
</div>
@endsection
