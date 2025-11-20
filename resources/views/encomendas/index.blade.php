@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Encomendas</h2>
    <a href="{{ route('encomendas.create') }}" class="btn btn-success">+ Nova Encomenda</a>
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
                <th style="width: 20%">Cliente</th>
                <th style="width: 15%">Data</th>
                <th style="width: 18%">Valor Total (R$)</th>
                <th style="width: 12%">Pago</th>
                <th style="width: 30%" class="text-center">Acoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($encomendas as $encomenda)
            <tr class="align-middle">
                <td><span class="badge bg-primary">{{ $encomenda->id }}</span></td>
                <td><strong>{{ $encomenda->cliente->nome }}</strong></td>
                <td>{{ \Carbon\Carbon::parse($encomenda->data)->format('d/m/Y H:i') }}</td>
                <td class="text-success fw-bold">R$ {{ number_format($encomenda->valor_total, 2, ',', '.') }}</td>
                <td class="text-center">
                    <input type="checkbox" class="status-toggle form-check-input" 
                        data-id="{{ $encomenda->id }}" 
                        {{ $encomenda->status === 'pago' ? 'checked' : '' }}
                        style="width: 20px; height: 20px; cursor: pointer;">
                </td>
                <td class="text-center">
                    <a href="{{ route('encomendas.show', $encomenda) }}" class="btn btn-sm btn-info" title="Ver">Ver</a>
                    <a href="{{ route('encomendas.edit', $encomenda) }}" class="btn btn-sm btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('encomendas.destroy', $encomenda) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir encomenda?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Nenhuma encomenda cadastrada</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.status-toggle').forEach(chk => {
    chk.addEventListener('change', function() {
        fetch(`/encomendas/${this.dataset.id}/status`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(res => console.log('Status atualizado'));
    });
});
</script>
@endsection
