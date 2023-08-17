@extends('template/layout')
@section('title', 'Pessoas Cadastradas')
@section('conteudo')

    <h1 class="display-6 mb-3">Pessoas Cadastradas</h1>

    <div class="input-group mb-3">
        <div class="input-group-append">
            <a href="{{ route('cadastrar') }}" class="btn btn-success"> Novo <i class="bi bi-plus"></i> </a>
        </div>
    </div>


    <table id="pessoasTable" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Idade</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
