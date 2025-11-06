@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($ingrediente) ? 'Editar Ingrediente' : 'Novo Ingrediente' }}</h2>

    <form action="{{ isset($ingrediente) ? route('ingredientes.update', $ingrediente) : route('ingredientes.store') }}" method="POST">
        @csrf
        @if(isset($ingrediente))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $ingrediente->nome ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>Unidade de Medida</label>
            <input type="text" name="unidade_medida" class="form-control" value="{{ $ingrediente->unidade_medida ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>Preço Unitário (R$)</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="{{ $ingrediente->preco ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
