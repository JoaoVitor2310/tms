@extends('layouts.app')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg p-4 w-100" style="max-width: 420px;">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo-tms-black.png') }}" alt="Logo TMS" style="max-height: 80px;">
                <h2 class="mt-3">Gerenciamento de Tarefas</h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                    <label for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required placeholder="Senha">
                    <label for="password">Senha</label>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <p>Não possui uma conta? <a href="{{ route('registerForm') }}">Cadastre-se</a></p>
                @if (session('error_message'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 p-3 rounded-3 shadow-sm fade show"
                        role="alert" id="error_message">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>{{ session('error_message') }}</div>
                    </div>
                @endif
                <button type="submit" class="btn btn-tms w-100 py-2">Entrar</button>
            </form>
        </div>
    </div>
@endsection