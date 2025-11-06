@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($estoque) ? 'Editar Estoque' : 'Novo Estoque' }}</h2>

    <form action="{{ isset($estoque) ? route('estoque.update', $estoque) : route('estoque.store') }}" method="POST">
        @csrf
        @if(isset($estoque))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Ingrediente</label>
            <select name="ingrediente_id" class="form-select" required>
                @foreach($ingredientes as $ing)
                    <option value="{{ $ing->id }}" @if(isset($estoque) && $estoque->ingrediente_id == $ing->id) selected @endif>
                        {{ $ing->nome }} ({{ $ing->unidade_medida }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Quantidade Atual</label>
            <input type="number" step="0.01" name="quantidade_atual" class="form-control" 
                   value="{{ old('quantidade_atual', $estoque->quantidade_atual ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
