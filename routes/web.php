<?php

use App\Http\Controllers\AnotacaoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Autenticação
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Anotacoes
    Route::resource('/anotacoes', AnotacaoController::class);

    //Categorias
    Route::resource('/categorias', CategoriaController::class);
});

// Fallback route para redirecionar qualquer URL inválida
Route::fallback(function () {
    return redirect()->route('loginForm');
});