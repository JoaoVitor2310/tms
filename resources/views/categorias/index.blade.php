@extends('layouts.app')

@section('content')
    <div class="container-md mt-3">
        <div class="card shadow-sm p-4 main">
            <h1><i class="bi bi-people text-primary me-1"></i> Gerenciar Categorias</h1>
            <div class="d-flex flex-column align-items-start mb-3">
                <p>Altere as informações das categorias do sistema.</p>
                <!-- Botão Criar Novo Usuário -->
                <a href="{{ route('categorias.create') }}" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i> Nova categoria</a>
            </div>

            <x-feedback-message />

            <!-- Tabela de Categorias -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria['id'] }}</td>
                                <td>{{ $categoria['nome'] }}</td>
                                <td>
                                    <a href="{{ route('categorias.edit', $categoria['id']) }}" class="edit-btn btn-sm" title="Editar"><i
                                            class="bi bi-pen"></i></a>
                                    <form action="{{ route('categorias.destroy', $categoria['id']) }}" method="POST"
                                        style="display:inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn btn-sm" title="Deletar"><i
                                                class="bi bi-trash"></i>
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
                    title: 'Deseja realmente excluir a categoria?',
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
    </script>

@endsection