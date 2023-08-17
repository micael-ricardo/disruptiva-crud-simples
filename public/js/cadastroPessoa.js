// Variável global
let pessoaId;

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
    if (!/^\d+$/.test(idade)) {
        toastr.error('A idade deve conter apenas números.');
    }
    if (senha !== confirmaSenha) {
        toastr.error('As senhas não coincidem.');
        return false;
    }
    return true;
}
// Função para verificar se o endereço está preenchido
function verificarEnderecoPreenchido() {
    const cep = $('#cep').val();
    const tipo_logradouro = $('#tipo_logradouro').val();
    const logradouro = $('#logradouro').val();
    const numero = $('#numero').val();
    const bairro = $('#bairro').val();
    const cidade = $('#cidade').val();
    return cep.trim() !== '' || tipo_logradouro.trim() !== '' || logradouro.trim() !== '' || numero.trim() !== '' || bairro.trim() !== '' || cidade.trim() !== '';
}
// Função para cadastrar pessoa
function cadastrarPessoa() {
    const dadosPessoa = $('#pessoa-form').serialize();
    $.post('/cadastrar-pessoa', dadosPessoa, function (response) {
        pessoaId = response.id;
        const enderecoPreenchido = verificarEnderecoPreenchido();
        if (enderecoPreenchido) {
            cadastrarEndereco(pessoaId);
        } else {
            toastr.success('Dados da pessoa salvos com sucesso!');
            window.location.href = '/';
        }
    });
}
// Validar Email
$(document).ready(function () {
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
        if (!validarFormulario()) {
            return;
        }
        cadastrarPessoa();
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
