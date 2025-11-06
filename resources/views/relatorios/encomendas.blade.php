@extends('layouts.app')

@section('title', 'Relatório de Encomendas')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Relatório de Encomendas</h1>

    @foreach($encomendas as $e)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">
                    Encomenda #{{ $e->id }} - {{ $e->cliente->nome }}
                </h4>
                <p class="card-text">
                    <strong>Endereço:</strong> {{ $e->cliente->endereco }}<br>
                    <strong>Telefone:</strong> {{ $e->cliente->telefone }}<br>
                    <strong>Data:</strong> {{ \Carbon\Carbon::parse($e->data)->format('d/m/Y') }}
                </p>

                <h5>Pratos:</h5>
                <ul class="list-group mb-2">
                    @foreach($e->pratos as $p)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $p->nome }}
                            <span>
                                Qtd: {{ $p->pivot->quantidade }} |
                                R$ {{ number_format($p->preco, 2, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <p class="fw-bold">
                    Total da Encomenda: 
                    R$ {{ number_format($e->pratos->sum(fn($p) => $p->preco * $p->pivot->quantidade), 2, ',', '.') }}
                </p>
            </div>
        </div>
    @endforeach
</div>
@endsection
