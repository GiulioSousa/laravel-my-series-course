<form action="{{ $action }}" method="post">
    @csrf
    {{-- @isset($nome) --}}
    {{-- @isset($update) --}}
    @if($update)
    @method('PUT')
    @endif
    {{-- @endisset --}}
    <div class="mb-3">
        <label class="form-label" for="nome">Nome:</label>
        <input  class="form-control" 
                type="text" 
                name="nome" 
                id="nome"
                @isset($nome) 
                value="{{ $nome }}"
                @endisset>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ isset($update) ? "Salvar" : "Adicionar" }}
    </button>
</form>