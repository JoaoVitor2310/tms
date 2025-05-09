@extends('layouts.app')

@section('content')
    <div class="container-lg mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-journal-text text-danger me-1"></i> Gerenciar Anotações</h1>
            <div class="d-flex flex-column align-items-start mb-3">
                <p>Altere as informações das anotacoes do sistema.</p>
                <!-- Botão Criar Novo Usuário -->
                <a href="{{ route('anotacoes.create') }}" class="btn btn-tms"><i class="bi bi-person-plus me-1"></i>
                    Nova anotação</a>
            </div>

            <form method="GET" action="{{ route('anotacoes.index') }}" class="d-flex flex-column flex-lg-row align-items-lg-end gap-2 mb-3">
                <div>
                    <label for="titulo" class="form-label">Titulo ou texto</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Buscar por Título ou texto"
                        value="{{ request('titulo') }}">
                </div>

                <div>
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="categoria" class="form-select">
                        <option value="">Todas as categorias</option>
                        <option value="null" {{ request('categoria') == 'null' ? 'selected' : '' }}>Sem categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
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

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Texto</th>
                            <th>Categoria</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anotacoes as $anotacao)
                            <tr class="clickable-row" data-href="{{ route('anotacoes.show', $anotacao->id) }}">
                                <td>{{ $anotacao->id }}</td>
                                <td>{{ $anotacao->titulo }}</td>
                                <td>{{ Str::limit($anotacao->texto, 20) }}</td>
                                <td>{{ $anotacao->categoria->nome ?? 'Sem categoria' }}</td>
                                <td>{{ Illuminate\Support\Carbon::parse($anotacao->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('anotacoes.show', $anotacao->id) }}" class="btn btn-outline-primary"
                                            title="Visualizar">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('anotacoes.edit', $anotacao->id) }}" class="btn btn-outline-secondary"
                                            title="Editar">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <form action="{{ route('anotacoes.destroy', $anotacao->id) }}" method="POST"
                                            class="delete-form m-0 p-0">
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
            <div class="d-flex justify-content-end mt-3">
                {{ $anotacoes->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="{{ asset('js/confirmDelete.js') }}"></script>
    <script src="{{ asset('js/anotacoes/index.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/anotacoes/index.css') }}">
@endsection