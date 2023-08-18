$(document).ready(function() {

    var apiUrl = '/get-data-table';
    var columns = [{
            data: 'nome'
        },
        {
            data: null,
            render: function(data, type, row) {
                if (row.enderecos) {
                    return row.enderecos.logradouro + ', ' +
                        row.enderecos.numero + ' - ' +
                        row.enderecos.bairro + ', ' +
                        row.enderecos.cidade.nome;
                } else {
                    return '-';
                }
            }
        },
        {
            data: 'idade'
        },
        {
            data: 'email'
        },
        {
            data: null,
            render: function(data, type, row) {
               var sexo = row.sexo === 'F' ? 'Feminino' : 'Masculino'
               return sexo;
            },
        },
        {
            data: null,
            render: function(data, type, row) {
                var nome = data.nome;
                var btnEditar = '<a href="#" class="btn btn-info btn-sm btn-editar" data-id="' + data.id + '"><i class="bi bi-pencil"></i></a>';
                var btnDeletar = '<button type="button"  data-id="' +  data.id + '" data-nome="' + nome +'" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>';
                return btnEditar + ' ' + btnDeletar;
            },
            className: 'text-center'
        }
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