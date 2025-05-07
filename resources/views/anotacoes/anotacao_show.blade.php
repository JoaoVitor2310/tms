@extends('layouts.app')

@section('content')
    <div class="container-md mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Anotação</h5>
                <span class="badge bg-light text-dark">{{ $anotacao->categoria->nome ?? 'Sem categoria' }}</span>
            </div>
            <div class="card-body">
                <h4 class="text-primary mb-3">{{ $anotacao->titulo }}</h4>

                <div class="mb-4">
                    <h6 class="text-muted"><i class="bi bi-body-text me-1"></i>Texto:</h6>
                    <p class="fs-5">{{ $anotacao->texto }}</p>
                </div>

                <div class="d-flex justify-content-between gap-2">
                    <a href="{{ route('anotacoes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Voltar para as Anotações
                    </a>
                    <a href="{{ route('anotacoes.edit', $anotacao->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-pencil-square me-1"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection