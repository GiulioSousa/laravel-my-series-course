<x-layout title="Nova Série">
    {{-- <x-form :action="route('series.store')" :nome="old('nome')" /> --}}

    {{-- <form action="{{ $action }}" method="post"> --}}
        <form action="{{ route('series.store') }}" method="post">
        @csrf
        {{-- @isset($nome) --}}
        {{-- @isset($update)
        @method('PUT')
        @endisset --}}
        <div class="row mb-3">
            <div class="col-8">
                <label class="form-label" for="nome">Nome:</label>
                <input  class="form-control" 
                autofocus
                type="text" 
                name="nome" 
                id="nome" 
                value="{{ old('nome') }}">
            </div>
            <div class="col-2">
                <label class="form-label" for="seasonsQty">Temporadas:</label>
                <input  class="form-control" 
                type="text" 
                name="seasonsQty" 
                id="seasonsQty" 
                value="{{ old('seasonsQty') }}">
            </div>
            <div class="col-2">
                <label class="form-label" for="episodesQty">Episódios:</label>
                <input  class="form-control" 
                type="text" 
                name="episodesQty" 
                id="episodesQty" 
                value="{{ old('episodesQty') }}">
            </div>
        </div>
            <button type="submit" class="btn btn-primary">
                {{ isset($update) ? "Salvar" : "Adicionar" }}
        </button>
    </form>

</x-layout>