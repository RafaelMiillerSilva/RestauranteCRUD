@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Ingredientes</h2>
    <a href="{{ route('ingredientes.create') }}" class="btn btn-primary">+ Novo Ingrediente</a>
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
                <th style="width: 35%">Nome</th>
                <th style="width: 20%">Unidade de Medida</th>
                <th style="width: 20%">Preco Unitario (R$)</th>
                <th style="width: 20%" class="text-center">Acoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ingredientes as $ingrediente)
            <tr class="align-middle">
                <td><span class="badge bg-info">{{ $ingrediente->id }}</span></td>
                <td><strong>{{ $ingrediente->nome }}</strong></td>
                <td><span class="badge bg-secondary">{{ $ingrediente->unidade_medida ?? '—' }}</span></td>
                <td class="text-success fw-bold">R$ {{ number_format($ingrediente->preco, 2, ',', '.') }}</td>
                <td class="text-center">
                    <a href="{{ route('ingredientes.edit', $ingrediente) }}" class="btn btn-sm btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('ingredientes.destroy', $ingrediente) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir ingrediente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Nenhum ingrediente cadastrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-2">
    {{ $ingredientes->links() }}
</div>
@endsection
