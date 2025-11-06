@extends('layouts.app')

@section('title', 'Detalhes do Cliente')

@section('content')
<h1>Detalhes do Cliente</h1>

<div class="card mt-3">
    <div class="card-body">
        <h4>{{ $cliente->nome }}</h4>
        <p><strong>Endereço:</strong> {{ $cliente->endereco }}</p>
        <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
    </div>
</div>

<a href="{{ route('clientes.index') }}" class="btn btn-primary mt-3">Voltar</a>
@endsection
