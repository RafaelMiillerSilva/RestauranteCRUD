@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($compra) ? 'Editar Compra' : 'Nova Compra' }}</h2>

    <form action="{{ isset($compra) ? route('compras.update', $compra) : route('compras.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @if(isset($compra))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nota Fiscal *</label>
                <input type="text" name="nota_fiscal" class="form-control" value="{{ $compra->nota_fiscal ?? '' }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Fornecedor *</label>
                <input type="text" name="fornecedor" class="form-control" value="{{ $compra->fornecedor ?? '' }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Data da Compra *</label>
                <input type="date" name="data_compra" class="form-control" value="{{ $compra->data_compra ?? '' }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Valor Total (R$) *</label>
                <input type="number" step="0.01" name="valor_total" class="form-control" value="{{ $compra->valor_total ?? '' }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status *</label>
            <select name="status" class="form-select" required>
                <option value="pendente" @if(isset($compra) && $compra->status == 'pendente') selected @endif>Pendente</option>
                <option value="pago" @if(isset($compra) && $compra->status == 'pago') selected @endif>Pago</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
