@extends('template/layout')
@section('title', 'Cadastrar Pessoas')
@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-6 mb-3">Cadastro de Pessoas</h1>
                <hr>
                <div class="card">
                    <h6 class="card-title "><span>Dados Pessoais</span></h6>
                    <div class="card-body">

                        <form method="POST">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="nome">Nome:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="idade">Idade:<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="idade" id="idade" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">E-mail:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="sexo">Sexo:</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="masculino" name="sexo"
                                                    value="M">
                                                <label class="form-check-label" for="masculino">Masculino</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="feminino" name="sexo"
                                                    value="F">
                                                <label class="form-check-label" for="feminino">Feminino</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="senha">Senha:</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="confirma_senha">Confirmar Senha:</label>
                                    <input type="password" class="form-control" id="confirma_senha" name="confirma_senha"
                                        required>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-title">
                        <h6><span>Endereço <small class="card-subtitle">(o endereço não é obrigatório, mas caso seja
                                    informado, os campos com * são obrigatórios )</small></span></h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="form-group col-md-3">
                                <label for="cep">Cep:</label>
                                <input type="text" name="cep" id="cep" class="form-control cep">
                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button id="BuscaCep" class="btn btn-secondary"><i class="bi bi-search"></i> Busca pelo
                                    cep</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="TipoLogradouro">Tipo Logradouro:<span class="text-danger">*</span></label>
                                <input type="text" name="TipoLogradouro" id="TipoLogradouro" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="rua">Logradouro:<span class="text-danger">*</span></label>
                                <input type="text" name="rua" id="rua" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Numero">Número:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="numero" id="numero" required>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bairro">Bairro:</label>
                                <input type="text" name="bairro" id="bairro" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="Cidade">Cidade:<span class="text-danger">*</span></label>
                                <input type="text" name="Cidade" id="Cidade" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar </button>
                <button id="limparCampos" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> Limpar</button>
                <a href="{{ route('listar') }}" class="btn btn-danger"><i class="bi bi-x-lg"></i> Cancelar</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/cadastro.js') }}"></script>
@endsection
