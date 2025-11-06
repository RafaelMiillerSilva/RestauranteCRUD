@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Prato</h1>

    <form action="{{ route('pratos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Preço (R$)</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>

        <h5>Ingredientes</h5>
        <div id="ingredientes-container">
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="ingredientes[]" class="form-select">
                        @foreach($ingredientes as $ing)
                            <option value="{{ $ing->id }}">{{ $ing->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" step="0.01" name="quantidades[]" class="form-control" placeholder="Qtd">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addIngrediente()">+ Adicionar Ingrediente</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
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
