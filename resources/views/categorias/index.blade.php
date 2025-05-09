@extends('layouts.app')

@section('content')
    <div class="container-lg mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-tags text-danger me-1"></i> Gerenciar Categorias</h1>
            <div class="d-flex flex-column align-items-start mb-3">
                <p>Altere as informações das categorias do sistema.</p>
                <!-- Botão Criar Novo Usuário -->
                <a href="{{ route('categorias.create') }}" class="btn btn-tms"><i class="bi bi-person-plus me-1"></i>
                    Nova categoria</a>
            </div>

            <form method="GET" action="{{ route('categorias.index') }}" class="d-flex flex-column flex-md-row align-items-md-end gap-2 mb-3">
                <div>
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Buscar por nome"
                        value="{{ request('nome') }}">
                </div>

                <div>
                    <label for="data_inicial" class="form-label">Data Inicial</label>
                    <input type="date" name="data_inicial" id="data_inicial" class="form-control"
                        value="{{ request('data_inicial') }}">
                </div>

                <div>
                    <label for="data_final" class="form-label">Data Final</label>
                    <input type="date" name="data_final" id="data_final" class="form-control"
                        value="{{ request('data_final') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-search me-1"></i> Buscar
                    </button>
                </div>
            </form>



            <x-feedback-message />

            <!-- Tabela de Categorias -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nome }}</td>
                                <td>{{ Illuminate\Support\Carbon::parse($categoria->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('categorias.edit', $categoria->id) }}"
                                            class="btn btn-outline-secondary" title="Editar">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                                            class="delete-form" data-title="Deseja realmente excluir a categoria?"
                                            data-text="Você não poderá reverter esta ação.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Deletar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/confirmDelete.js') }}"></script>
@endsection