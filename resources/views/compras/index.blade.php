@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Compras</h2>
    <a href="{{ route('compras.create') }}" class="btn btn-success">+ Nova Compra</a>
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
                <th style="width: 20%">Nota Fiscal</th>
                <th style="width: 20%">Fornecedor</th>
                <th style="width: 15%">Data</th>
                <th style="width: 15%">Valor (R$)</th>
                <th style="width: 10%">Pago</th>
                <th style="width: 15%" class="text-center">Acoes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($compras as $compra)
            <tr class="align-middle">
                <td><span class="badge bg-secondary">{{ $compra->id }}</span></td>
                <td><strong>{{ $compra->nota_fiscal }}</strong></td>
                <td>{{ $compra->fornecedor }}</td>
                <td>{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                <td><strong class="text-success">R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</strong></td>
                <td class="text-center">
                    <input type="checkbox" class="status-toggle-compra form-check-input" 
                        data-id="{{ $compra->id }}" 
                        {{ $compra->status === 'pago' ? 'checked' : '' }}
                        style="width: 20px; height: 20px; cursor: pointer;">
                </td>
                <td class="text-center">
                    <a href="{{ route('compras.edit', $compra) }}" class="btn btn-sm btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('compras.destroy', $compra) }}" method="POST" class="d-inline" onsubmit="return confirm('Excluir compra?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">Nenhuma compra cadastrada</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-2">
    {{ $compras->links() }}
</div>

<script>
document.querySelectorAll('.status-toggle-compra').forEach(chk => {
    chk.addEventListener('change', function() {
        fetch(`/compras/${this.dataset.id}/status`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(res => console.log('Status atualizado para: ' + res.status));
    });
});
</script>
@endsection
