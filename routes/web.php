<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoLogradouroController;
use App\Http\Controllers\CidadeController;
// views
Route::get('/', function () {
    return view('listar');
})->name('listar');

Route::get('/cadastrar', function () {
    return view('cadastrar');
})->name('cadastrar');;
// Controllers
Route::get('/get-tipos-logradouros', [TipoLogradouroController::class, 'getTiposLogradouros'])->name('get-tipos-logradouros');
Route::get('/get-cidades', [CidadeController::class, 'getCidades'])->name('get-cidades');