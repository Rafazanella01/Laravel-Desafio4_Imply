<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/livros', [LivroController::class, 'listarLivros']);
Route::post('/livros', [LivroController::class, 'criarLivro']);
Route::get('/livros/{id}', [LivroController::class, 'mostrarLivro']);
Route::put('/livros/{id}', [LivroController::class, 'atualizarLivro']);
Route::delete('/livros/{id}', [LivroController::class, 'deletarLivro']);
