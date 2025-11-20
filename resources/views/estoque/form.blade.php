@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($estoque) ? 'Editar Estoque' : 'Novo Estoque' }}</h2>

    <form action="{{ isset($estoque) ? route('estoque.update', $estoque) : route('estoque.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @if(isset($estoque))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ingrediente *</label>
                <select name="ingrediente_id" class="form-select" required id="ingrediente_select">
                    <option value="">Selecione um ingrediente</option>
                    @foreach($ingredientes as $ing)
                        <option value="{{ $ing->id }}" data-unidade="{{ $ing->unidade_medida ?? '' }}" @if(isset($estoque) && $estoque->ingrediente_id == $ing->id) selected @endif>
                            {{ $ing->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Unidade de Medida</label>
                <input type="text" name="unidade_display" class="form-control" id="unidade_medida" 
                       value="{{ isset($estoque) && $estoque->ingrediente ? $estoque->ingrediente->unidade_medida : '' }}" 
                       placeholder="Sera preenchido automaticamente">
                <small class="text-muted">Campo informativo baseado no ingrediente selecionado</small>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade *</label>
            <input type="number" step="0.01" name="quantidade" class="form-control" 
                   value="{{ old('quantidade', $estoque->quantidade ?? '') }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.getElementById('ingrediente_select').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const unidade = selectedOption.getAttribute('data-unidade') || '—';
    document.getElementById('unidade_medida').value = unidade;
});

window.addEventListener('load', function() {
    const select = document.getElementById('ingrediente_select');
    if (select.value) {
        const selectedOption = select.options[select.selectedIndex];
        const unidade = selectedOption.getAttribute('data-unidade') || '—';
        document.getElementById('unidade_medida').value = unidade;
    }
});
</script>
@endsection
