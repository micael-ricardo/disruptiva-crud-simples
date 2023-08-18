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
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    {{-- Modal Delete --}}
    <div class="modal fade" id="ModalDeletar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Excluir Pessoa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal-body" class="modal-body">
                    Tem certeza que deseja excluir: <b><span id="nome-pessoa"> </span></b> ? Esta ação
                    não pode ser desfeita.
                </div>
                <div class="modal-footer">
                    <form id="formExcluir" method="post">
                        @csrf
                        <input type="hidden" name="id">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script src="{{ asset('js/modalDelete.js') }}"></script>

@endsection
