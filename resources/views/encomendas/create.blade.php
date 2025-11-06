@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Encomenda</h1>

    <form action="{{ route('encomendas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-select">
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <h5>Pratos</h5>
        <div id="pratos-container">
            <div class="row mb-2">
                <div class="col-md-6">
                    <select name="pratos[]" class="form-select">
                        @foreach($pratos as $prato)
                            <option value="{{ $prato->id }}">{{ $prato->nome }} - R$ {{ number_format($prato->preco, 2, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="quantidades[]" class="form-control" min="1" placeholder="Qtd">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addPrato()">+ Adicionar Prato</button>
        <button type="submit" class="btn btn-primary">Salvar Encomenda</button>
    </form>
</div>

<script>
function addPrato() {
    const container = document.getElementById('pratos-container');
    const clone = container.children[0].cloneNode(true);
    container.appendChild(clone);
}
</script>
@endsection
