@extends('layouts.app')
@section('content')
    <div class="container-md mt-3">

        <h1>Bem vindo, {{ Auth::user()->name }}!</h1>
        <div class="row">
            <h2>Acesso rápido</h2>
            <div class="col-md-6 mt-2">
                <div class="card text-center card-hover" style="height: 100%;">
                    <div class="card-body">
                        <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Anotações</h5>
                        <p class="card-text">Gerencie as anotações.</p>
                        <a href="{{route('anotacoes.index')}}" class="btn btn-tms">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="card text-center card-hover" style="height: 100%;">
                    <div class="card-body">
                        <i class="bi bi-tags" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Categorias</h5>
                        <p class="card-text">Gerencie as categorias.</p>
                        <a href="{{route('categorias.index')}}" class="btn btn-tms">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

    </style>

@endsection