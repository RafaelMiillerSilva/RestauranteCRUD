@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">+ Novo Cliente</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-responsive shadow-sm flex-grow-1 d-flex flex-column">
    <table class="table table-hover table-striped mb-0">
        <thead class="table-dark sticky-top">
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 25%">Nome</th>
                <th style="width: 20%">Telefone</th>
                <th style="width: 25%">Email</th>
                <th style="width: 15%">Endereco</th>
                <th style="width: 10%" class="text-center">Acoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
            <tr class="align-middle">
                <td><span class="badge bg-primary">{{ $cliente->id }}</span></td>
                <td><strong>{{ $cliente->nome }}</strong></td>
                <td>{{ $cliente->telefone ?? '—' }}</td>
                <td>{{ $cliente->email ?? '—' }}</td>
                <td>{{ $cliente->endereco ?? '—' }}</td>
                <td class="text-center">
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir cliente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Nenhum cliente cadastrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-2">
    {{ $clientes->links() }}
</div>
@endsection
