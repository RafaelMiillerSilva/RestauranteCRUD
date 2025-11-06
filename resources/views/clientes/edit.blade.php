@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Editar Cliente</h2>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome *</label>
            <input type="text" name="nome" value="{{ $cliente->nome }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" value="{{ $cliente->telefone }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $cliente->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" value="{{ $cliente->endereco }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
