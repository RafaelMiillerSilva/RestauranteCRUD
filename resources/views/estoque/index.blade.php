@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Estoque</h2>
        <a href="{{ route('estoque.create') }}" class="btn btn-primary">+ Novo Estoque</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ingrediente</th>
                <th>Quantidade Atual</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estoques as $estoque)
            <tr>
                <td>{{ $estoque->id }}</td>
                <td>{{ $estoque->ingrediente->nome }}</td>
                <td>{{ $estoque->quantidade_atual }}</td>
                <td class="text-end">
                    <a href="{{ route('estoque.edit', $estoque) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                    <form action="{{ route('estoque.destroy', $estoque) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir estoque?')">🗑️ Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $estoques->links() }}
</div>
@endsection
