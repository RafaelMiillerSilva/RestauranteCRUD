@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Novo Cliente</h2>

    <form action="{{ route('clientes.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome *</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
