@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Ingredientes</h2>
        <a href="{{ route('ingredientes.create') }}" class="btn btn-primary">+ Novo Ingrediente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Unidade de Medida</th>
                <th>Preço Unitário (R$)</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredientes as $ingrediente)
            <tr>
                <td>{{ $ingrediente->id }}</td>
                <td>{{ $ingrediente->nome }}</td>
                <td>{{ $ingrediente->unidade_medida }}</td>
                <td>{{ number_format($ingrediente->preco, 2, ',', '.') }}</td>
                <td class="text-end">
                    <a href="{{ route('ingredientes.edit', $ingrediente) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                    <form action="{{ route('ingredientes.destroy', $ingrediente) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir ingrediente?')">🗑️ Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ingredientes->links() }}
</div>
@endsection
