@extends('template/layout')
@if (isset($pessoa))
    @section('title', 'Editar Pessoas')
@else
    @section('title', 'Cadastrar Pessoas')
@endif
@section('conteudo')
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-6 mb-3">{{ isset($pessoa) ? 'Editar Pessoas' : 'Cadastro Pessoas' }}</h1>
                <hr>
                <div class="card">
                    <h6 class="card-title "><span>Dados Pessoais</span></h6>
                    <div class="card-body">
                        <form id="pessoa-form" method="POST">
                            @csrf
                            @if (isset($pessoa))
                                @method('PUT')
                                <input type="hidden" id="pessoa_id" name="pessoa_id"
                                    value="{{ isset($pessoa) ? $pessoa->id : '' }}">
                            @endif
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="nome">Nome:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nome" id="nome"
                                        value="{{ old('nome', isset($pessoa) ? $pessoa->nome : '') }}"required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="idade">Idade:<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="idade" id="idade"
                                        value="{{ old('idade', isset($pessoa) ? $pessoa->idade : '') }}"required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">E-mail:<span class="text-danger">*</span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="email"
                                        id="email"
                                        value="{{ old('email', isset($pessoa) ? $pessoa->email : '') }}"required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="sexo">Sexo:</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="masculino" name="sexo"
                                                    value="M"
                                                    {{ isset($pessoa) && $pessoa->sexo === 'M' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="masculino">Masculino</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="feminino" name="sexo"
                                                    value="F"
                                                    {{ isset($pessoa) && $pessoa->sexo === 'F' ? 'checked' : '' }}>
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
                                    <input type="password" class="form-control" id="confirma_senha"
                                        name="senha_confirmation" required>
                                </div>
                            </div>
                        </form>
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
                        <form id="endereco-form" method="POST">
                            @csrf
                            @if (isset($pessoa->enderecos))
                                @method('PUT')
                                <input type="hidden" name="endereco_id" id="endereco_id" value="{{ $pessoa->enderecos->id }}">
                                {{-- <input type="hidden" name="pessoa_id_update" id="pessoa_id_update" value="{{ $pessoa->id }}"> --}}
                            @endif
                            <div class="row mb-2">
                                <div class="form-group col-md-3">
                                    <label for="cep">Cep:</label>
                                    <input type="text" name="cep" id="cep" class="form-control cep"
                                        value="{{ old('cep', isset($pessoa->enderecos) ? $pessoa->enderecos->cep : '') }}"required>
                                </div>
                                <div class="form-group col-md-3 mt-4">
                                    <button type="button" id="BuscaCep" class="btn btn-secondary"><i
                                            class="bi bi-search"></i> Busca pelo
                                        cep</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="tipo_logradouro">Tipo de Logradouro: <span
                                            class="text-danger">*</span></label>
                                    <select name="tipo_logradouro_id" id="tipo_logradouro" class="form-control">
                                        <option {{ old('tipo_logradouro_id') }} value="">Escolha uma opção</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="logradouro">Logradouro:<span class="text-danger">*</span></label>
                                    <input type="text" name="logradouro" id="logradouro" class="form-control"
                                        value="{{ old('logradouro', isset($pessoa->enderecos) ? $pessoa->enderecos->logradouro : '') }}"required>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="numero">Número:<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="numero" id="numero"
                                            value="{{ old('numero', isset($pessoa->enderecos) ? $pessoa->enderecos->numero : '') }}"required>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control"
                                        value="{{ old('bairro', isset($pessoa->enderecos) ? $pessoa->enderecos->bairro : '') }}"required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cidade">Cidade:<span class="text-danger">*</span></label>
                                    <select name="cidade_id" id="cidade" class="form-control">
                                        <option {{ old('cidade_id') }} value="">Escolha uma opção</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <button id="salvar" class="btn btn-success"><i class="bi bi-save"></i> Salvar </button>
                <button id="limparCampos" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> Limpar</button>
                <a href="{{ route('listar') }}" class="btn btn-danger"><i class="bi bi-x-lg"></i> Cancelar</a>
            </div>
        </div>
    </div>

    @if (isset($pessoa))
        @if (isset($pessoa->enderecos->tipo_logradouro_id))
            <script>
                const tipo_logradouro_id = '{{ $pessoa->enderecos->tipo_logradouro_id }}';
            </script>
        @endif
        @if (isset($pessoa->enderecos->cidade_id))
            <script>
                const cidadeId = '{{ $pessoa->enderecos->cidade_id }}';
            </script>
        @endif
    @endif
    <script src="{{ asset('js/cadastroPessoa.js') }}"></script>
    <script src="{{ asset('js/cadastroEndereco.js') }}"></script>
@endsection
