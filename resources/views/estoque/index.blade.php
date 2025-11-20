@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Estoque</h2>
    <a href="{{ route('estoque.create') }}" class="btn btn-primary">+ Novo Estoque</a>
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
                <th style="width: 40%">Ingrediente</th>
                <th style="width: 25%">Unidade</th>
                <th style="width: 20%">Quantidade</th>
                <th style="width: 10%" class="text-center">Acoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($estoques as $estoque)
            <tr class="align-middle">
                <td><span class="badge bg-success">{{ $estoque->id }}</span></td>
                <td><strong>{{ $estoque->ingrediente->nome }}</strong></td>
                <td><span class="badge bg-light text-dark">{{ $estoque->ingrediente->unidade_medida ?? '—' }}</span></td>
                <td>
                    @if($estoque->quantidade < 10)
                        <span class="badge bg-danger">{{ $estoque->quantidade }}</span>
                    @elseif($estoque->quantidade < 30)
                        <span class="badge bg-warning text-dark">{{ $estoque->quantidade }}</span>
                    @else
                        <span class="badge bg-success">{{ $estoque->quantidade }}</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('estoque.edit', $estoque) }}" class="btn btn-sm btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('estoque.destroy', $estoque) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir estoque?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Nenhum estoque cadastrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-2">
    {{ $estoques->links() }}
</div>
@endsection
