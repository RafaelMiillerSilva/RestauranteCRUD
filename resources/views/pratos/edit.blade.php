@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Prato</h1>

    <form action="{{ route('pratos.update', $prato->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $prato->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control">{{ $prato->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label>Preço (R$)</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="{{ $prato->preco }}" required>
        </div>

        <h5>Ingredientes</h5>
        <div id="ingredientes-container">
            @foreach($prato->ingredientes as $ing)
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="ingredientes[]" class="form-select">
                        @foreach($ingredientes as $i)
                            <option value="{{ $i->id }}" @if($i->id == $ing->id) selected @endif>{{ $i->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" step="0.01" name="quantidades[]" class="form-control" value="{{ $ing->pivot->quantidade }}">
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addIngrediente()">+ Adicionar Ingrediente</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<script>
function addIngrediente() {
    const container = document.getElementById('ingredientes-container');
    const clone = container.children[0].cloneNode(true);
    container.appendChild(clone);
}
</script>
@endsection
