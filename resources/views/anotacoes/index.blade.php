@extends('layouts.app')

@section('content')
    <div class="container-md mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-people text-primary me-1"></i> Gerenciar Anotações</h1>
            <div class="d-flex flex-column align-items-start mb-3">
                <p>Altere as informações das anotacoes do sistema.</p>
                <!-- Botão Criar Novo Usuário -->
                <a href="{{ route('anotacoes.create') }}" class="btn btn-tms"><i class="bi bi-person-plus me-1"></i>
                    Nova anotacao</a>
            </div>

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
                                    <a href="{{ route('anotacoes.show', $anotacao->id) }}" class="btn btn-outline-primary"
                                        title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('anotacoes.edit', $anotacao->id) }}" class="btn btn-outline-secondary"
                                        title="Editar">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    <form action="{{ route('anotacoes.destroy', $anotacao->id) }}" method="POST"
                                        style="display:inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Deletar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // SweetAlert de confirmação de exclusão
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Impede o envio imediato do formulário

                Swal.fire({
                    title: 'Deseja realmente excluir a anotação?',
                    text: "Você não poderá reverter esta ação.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envia o formulário se o usuário confirmar
                        form.submit();
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.clickable-row').forEach(function (row) {
                row.addEventListener('click', function (e) {
                    // Evita o clique se foi em um botão (editar/deletar)
                    if (e.target.closest('a') || e.target.closest('form')) return;
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>

    <style>
        .clickable-row {
            cursor: pointer;
        }

        .clickable-row:hover {
            background-color: #f5f5f5;
        }
    </style>

@endsection