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
                {{-- <th>Idade</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th>Ações</th> --}}
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>


    <script>
        $(document).ready(function() {

            var apiUrl = '/get-data-table';
            var columns = [{
                    data: 'id',
                    className: 'text-center'
                },
                {
                    data: 'nome'
                },
            ]
            $('#pessoasTable').DataTable({
                ajax: {
                    url: apiUrl,
                    method: 'GET',
                },
                columns: columns,
                scrollX: true,
                responsive: true,
                language: {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                },
                lengthMenu: [
                    [5, 10, 20, 50, -1],
                    [5, 10, 20, 50, "Todos"]
                ],
                pageLength: 5
            });
        });
    </script>

@endsection
