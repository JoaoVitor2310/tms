@extends('layouts.app')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg p-4 w-100" style="max-width: 420px;">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo-tms-black.png') }}" alt="Logo TMS" style="max-height: 80px;">
                <h2 class="mt-3">Gerenciamento de Tarefas</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="name" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required autofocus placeholder="João">
                    <label for="name">Nome</label>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

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
                
                <div class="form-floating mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" required placeholder="Confirme a senha">
                    <label for="password_confirmation">Confirme a Senha</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn tms-bg w-100 py-2">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection