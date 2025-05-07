@extends('layouts.app')
@section('content')
    <div class="container-md mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-file-text text-primary"></i>
                @if(isset($anotacao))
                    Editar Anotacao
                @else
                    Cadastro de Anotacao
                @endif
            </h1>

            <p>
                @if(isset($anotacao))
                    Altere as informações da anotacao.
                @else
                    Informe o nome da nova anotacao.
                @endif
            </p>

            <x-feedback-message />

            <form method="POST"
                action="{{ isset($anotacao) ? route('anotacoes.update', $anotacao->id) : route('anotacoes.store') }}">
                @csrf
                @if(isset($anotacao))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="titulo" class="form-label fw-bold">Título</label>
                    <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                        value="{{ old('titulo', $anotacao->titulo ?? '') }}" required
                        placeholder="Ex: Compra no mercado, Reunião do trabalho...">

                </div>

                <div class="mb-3">
                    <label for="texto" class="form-label fw-bold">Texto</label>
                    <textarea id="texto" class="form-control @error('texto') is-invalid @enderror" name="texto" rows="5"
                        required
                        placeholder="Escreva aqui o conteúdo da anotação...">{{ old('texto', $anotacao->texto ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label fw-bold">Categoria</label>
                    <select id="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror"
                        name="categoria_id">
                        
                        <option value="" {{ old('categoria_id', $anotacao->categoria_id ?? '') === null ? 'selected' : '' }}>
                            Sem categoria
                        </option>
                
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $anotacao->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('anotacoes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($anotacao))
                            <i class="bi bi-pencil-square"></i> Editar
                        @else
                            <i class="bi bi-folder-plus"></i> Cadastrar
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection