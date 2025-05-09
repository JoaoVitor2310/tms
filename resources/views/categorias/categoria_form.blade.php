@extends('layouts.app')

@section('content')
    <div class="container-md mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-tags text-danger"></i>
                @if(isset($categoria))
                    Editar Categoria
                @else
                    Cadastro de Categoria
                @endif
            </h1>

            <p>
                @if(isset($categoria))
                    Altere as informações da categoria.
                @else
                    Informe o nome da nova categoria.
                @endif
            </p>

            <x-feedback-message />

            <form method="POST"
                action="{{ isset($categoria) ? route('categorias.update', $categoria->id) : route('categorias.store') }}">
                @csrf
                @if(isset($categoria))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome da Categoria</label>
                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome"
                        value="{{ old('nome', isset($categoria) ? $categoria->nome : '') }}" required
                        placeholder="Ex: Pessoal, Trabalho, etc.">

                    @error('nome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        @if(isset($categoria))
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