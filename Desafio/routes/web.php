<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/livros', [LivroController::class, 'listarLivros']);
Route::post('/livros', [LivroController::class, 'criarLivro']);
Route::get('/livros/{id}', [LivroController::class, 'mostrarLivro']);
Route::put('/livros/{id}', [LivroController::class, 'atualizarLivro']);
Route::delete('/livros/{id}', [LivroController::class, 'deletarLivro']);
