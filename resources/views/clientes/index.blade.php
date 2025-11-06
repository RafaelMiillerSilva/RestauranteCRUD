@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👥 Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">+ Novo Cliente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->endereco }}</td>
                <td class="text-end">
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir cliente?')">🗑️ Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clientes->links() }}
</div>
@endsection
