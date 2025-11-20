@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Encomenda #{{ $encomenda->id }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $encomenda->cliente->nome }}</p>
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($encomenda->data)->format('d/m/Y H:i') }}</p>
            <p><strong>Status:</strong> <span class="badge {{ $encomenda->status === 'pago' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($encomenda->status) }}</span></p>
        </div>
    </div>

    <h5>Itens da Encomenda</h5>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Prato</th>
                <th>Quantidade</th>
                <th>Preco Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($encomenda->itens as $item)
            <tr>
                <td>{{ $item->prato->nome }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="alert alert-info">
        <strong>Valor Total:</strong> R$ {{ number_format($encomenda->valor_total, 2, ',', '.') }}
    </div>

    <a href="{{ route('encomendas.edit', $encomenda) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('encomendas.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
