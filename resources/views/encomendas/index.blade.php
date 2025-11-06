@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2> Encomendas</h2>
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
                <th>Pago</th>
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

                <td class="text-center">
                    <input type="checkbox" class="status-toggle"
                        data-id="{{ $encomenda->id }}"
                        {{ $encomenda->status === 'pago' ? 'checked' : '' }}>
                </td>

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

{{-- SCRIPT PARA MARCAR COMO PAGO --}}
<script>
document.querySelectorAll('.status-toggle').forEach(chk => {
    chk.addEventListener('change', function() {
        fetch(`/encomendas/${this.dataset.id}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(res => console.log(res.message));
    });
});
</script>

@endsection
