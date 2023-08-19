// Variável global
let pessoaId;
var pessoaUpdateSuccess = false;

// Validar Email
function validar_email(email) {
    const regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?$/;
    return regex.test(email);
}
// Validar campos
function validarFormulario() {
    const nome = $('#nome').val();
    const idade = $('#idade').val();
    const email = $('#email').val();
    const senha = $('#senha').val();
    const confirmaSenha = $('#confirma_senha').val();
    if (nome.trim() === '' || idade.trim() === '' || email.trim() === '' || senha.trim() === '' || confirmaSenha.trim() === '') {
        toastr.error('Todos os campos são obrigatórios.');
        return false;
    }
    if (!/^\d+$/.test(idade) || idade <= 0) {
        toastr.error('A idade deve conter apenas números e tem que ser maior que 0.');
        return false;
    }
    if (senha !== confirmaSenha) {
        toastr.error('As senhas não coincidem.');
        return false;
    }
    return true;
}
// Função para verificar se os dados do  endereço está preenchido
function verificarEnderecoPreenchido() {
    const tipo_logradouro = $('#tipo_logradouro').val();
    const logradouro = $('#logradouro').val();
    const numero = $('#numero').val();
    const cidade = $('#cidade').val();
    return  tipo_logradouro.trim() !== '' || logradouro.trim() !== '' || numero.trim() !== '' || cidade.trim() !== '';
}
// Função para cadastrar pessoa
function cadastrarPessoa() {
        const dadosPessoa = $('#pessoa-form').serialize();
        $.post('/cadastrar-pessoa', dadosPessoa, function (response, textStatus, xhr) {
            pessoaId = response.id;
            const enderecoPreenchido = verificarEnderecoPreenchido();
            if (enderecoPreenchido) {
                salvarEndereco(pessoaId);
            } else {
                toastr.success('Dados da pessoa salvos com sucesso!');
                window.location.href = '/';
            }
        }).fail(function (xhr, textStatus, errorThrown) {
            var errorMessage = xhr.responseJSON.message;
            if (xhr.status === 422) {
                toastr.error(errorMessage);
            } else {
                toastr.error('Ocorreu um erro ao cadastrar a pessoa. Por favor, tente novamente mais tarde.');
            }
        });
    }

// Função para atualizar pessoa
function atualizarPessoa() {
    const dadosPessoa = $('#pessoa-form').serialize();
    var pessoaId = $("#pessoa_id").val();
    $.ajax({
        url: "/update-pessoa/" + pessoaId,
        type: "PUT",
        data: dadosPessoa,
        success: function (response) {
            toastr.success('Dados da pessoa atualizados com sucesso!');
            window.location.href = '/';
            atualizacaoPessoaSucesso = true;
        },
        error: function (xhr, textStatus, errorThrown) {
            var errorMessage = xhr.responseJSON.message;
            if (xhr.status === 422) {
                toastr.error(errorMessage);
            } else {
                toastr.error('Ocorreu um erro ao atualizar a pessoa. Por favor, tente novamente mais tarde.');
            }
            return;
        },
    });
}


$(document).ready(function () {
    // Validar Email
    $('#email').on('blur', function () {
        const email = $(this).val();
        if (validar_email(email)) {
            toastr.success("E-mail válido!");
        } else {
            toastr.error("E-mail inválido!");
        }
    });
    // cadastrar pessoa
    $('#salvar').click(function (event) {
        event.preventDefault();
        var pessoaId = $("#pessoa_id").val();
        if (!validarFormulario()) {
            return;
        }
        if (pessoaId) {
            atualizarPessoa();
        } else {
            cadastrarPessoa();
        }
    });
    // Limpar Campos
    $('#limparCampos').click(function () {
        $('input[type="text"]').val('');
        $('input[type="password"]').val('');
        $('input[type="number"]').val('');
        $("input[type='radio']").prop("checked", false);
        $('select').prop('selectedIndex', 0);
    });
});
