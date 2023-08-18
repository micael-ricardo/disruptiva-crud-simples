// Validar campos
function validarFormularioEndereco() {
    const tipo_logradouro = $('#tipo_logradouro').val();
    const logradouro = $('#logradouro').val();
    const numero = $('#numero').val();
    const cidade = $('#cidade').val();
    if (tipo_logradouro.trim() === '' || logradouro.trim() === '' || numero.trim() === '' || cidade.trim() === '') {
        toastr.error('Todos os campos com * são obrigatórios.');
        return false;
    }
    if (!/^\d+$/.test(numero) || numero <= 0) {
        toastr.error('O Número deve conter apenas valores númericos e tem que ser maior que 0.');
        return false;
    }
    return true;
}
// Cadastrar Endereco
function cadastrarEndereco(pessoaId) {
    if (pessoaId) {
        if (!validarFormularioEndereco()) {
            return;
        }
    }
    const dadosEndereco = $('#endereco-form').serialize() + '&pessoa_id=' + pessoaId;
    $.post('/cadastrar-endereco', dadosEndereco, function (response) {
        toastr.success('cadastrado com sucesso!');
        window.location.href = '/';
    });
}
$(document).ready(function () {
    // CEP
    $("#BuscaCep").click(function () {
        var cep = $("#cep").val();
        cep = cep.replace(/\D/g, '');
        if (cep.length === 8) {
            $.ajax({
                url: 'https://viacep.com.br/ws/' + cep + '/json/',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (!data.erro) {
                        $("#bairro").val(data.bairro);
                        $("#logradouro").val(data.logradouro);
                    } else {
                        toastr.error('CEP não encontrado.');
                    }
                },
                error: function () {
                    toastr.error('Erro na consulta ao ViaCEP');
                }
            });
        } else {
            toastr.error('Cep não existe');
        }
    });
    //Mascara  Cep
    $('#cep').inputmask('99.999-999');

    // Select TipoLogradouros
    $.get("/get-tipos-logradouros", function (data) {
        const select = $("#tipo_logradouro");
        $.each(data, function (index, tipo) {
            select.append(new Option(tipo.nome, tipo.id));
        });
        if (typeof tipo_logradouro_id !== 'undefined') {
            select.val(tipo_logradouro_id);
        }
    });
    // Select Cidades
    $.get("/get-cidades", function (data) {
        const select = $("#cidade");
        $.each(data, function (index, tipo) {
            select.append(new Option(tipo.nome, tipo.id));
        });
        if (typeof cidadeId !== 'undefined') {
            select.val(cidadeId);
        }
    });

    // Cadastrar Endereco
    $('#salvar').click(function (event) {
        event.preventDefault();
        cadastrarEndereco(pessoaId);
    });
});
