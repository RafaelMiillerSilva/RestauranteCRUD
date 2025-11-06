@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($compra) ? 'Editar Compra' : 'Nova Compra' }}</h2>

    <form action="{{ isset($compra) ? route('compras.update', $compra) : route('compras.store') }}" method="POST">
        @csrf
        @if(isset($compra))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Fornecedor</label>
            <input type="text" name="fornecedor" class="form-control" value="{{ $compra->fornecedor ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>Valor Total (R$)</label>
            <input type="number" step="0.01" name="valor_total" class="form-control" value="{{ $compra->valor_total ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="pendente" @if(isset($compra) && $compra->status == 'pendente') selected @endif>Pendente</option>
                <option value="pago" @if(isset($compra) && $compra->status == 'pago') selected @endif>Pago</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
