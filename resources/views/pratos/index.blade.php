@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🍽️ Pratos</h1>
    <a href="{{ route('pratos.create') }}" class="btn btn-success mb-4">Novo Prato</a>

    <div class="row">
        @foreach($pratos as $prato)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $prato->nome }}</h5>
                    <p class="card-text">{{ $prato->descricao }}</p>
                    <p><strong>Preço:</strong> R$ {{ number_format($prato->preco, 2, ',', '.') }}</p>
                    <h6>Ingredientes:</h6>
                    <ul>
                        @foreach($prato->ingredientes as $ing)
                            <li>{{ $ing->nome }} - {{ $ing->pivot->quantidade }} {{ $ing->unidade_medida }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('pratos.edit', $prato->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('pratos.destroy', $prato->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')">Apagar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
