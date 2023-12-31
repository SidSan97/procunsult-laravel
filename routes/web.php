<?php

use App\Http\Controllers\CriarChamadoController;
use App\Http\Controllers\MeuChamadosController;
use App\Http\Controllers\ResponderChamadoController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::post('/enviar-chamado',[CriarChamadoController::class, 'abrirChamado'])->middleware('auth');;
Route::get('/abrir-chamado',[CriarChamadoController::class, 'index'])->middleware('auth');;
Route::get('/responder-chamado',[ResponderChamadoController::class, 'obterDados'])->middleware('auth');
Route::put('/editar-chamado/{id}',[ResponderChamadoController::class, 'responderChamado'])->middleware('auth');
Route::get('/meus-chamados/{id}',[MeuChamadosController::class, 'listarChamados'])->middleware('auth');
Route::post('/envio-resposta-cliente',[MeuChamadosController::class, 'envioResposta'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
