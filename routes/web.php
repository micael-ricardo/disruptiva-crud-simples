<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoLogradouroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;


// views
Route::get('/', function () {
    return view('listar');
})->name('listar');

Route::get('/cadastrar', function () {
    return view('cadastrar');
})->name('cadastrar');;
// Controllers

// Listar dados
Route::get('/get-tipos-logradouros', [TipoLogradouroController::class, 'getTiposLogradouros'])->name('get-tipos-logradouros');
Route::get('/get-cidades', [CidadeController::class, 'getCidades'])->name('get-cidades');
Route::get('/get-data-table', [DataTableController::class, 'listar'])->name('get-data-table');

// Cadastrar
Route::post('/cadastrar-pessoa', [PessoaController::class, 'store'])->name('cadastrar-pessoa');
Route::post('/cadastrar-endereco', [EnderecoController::class, 'store'])->name('cadastrar-endereco');

// Deletar
Route::delete('/delete-pessoas/{id}', [PessoaController::class, 'deletePessoa'])->name('delete-pessoas');