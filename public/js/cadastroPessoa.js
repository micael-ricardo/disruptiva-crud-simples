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
$(document).ready(function () {
    $('#email').on('blur', function () {
        console.log('Entrou');
        const email = $(this).val();
        if (validar_email(email)) {
            toastr.success("E-mail válido!");
        } else {
            toastr.error("E-mail inválido!");
        }
    });
    // Cadastro Pessoa
    $('#salvar').click(function (event) {
        event.preventDefault();
        if (!validarFormulario()) {
            return;
        }
        const dadosPessoa = $('#pessoa-form').serialize();
        $.post('/cadastrar-pessoa', dadosPessoa, function (response) {
            console.log(response);
            toastr.success('Pessoa cadastrada com sucesso!');
            window.location.href = '/';
        });
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
