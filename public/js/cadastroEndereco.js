// Cadastrar Endereco
function cadastrarEndereco(pessoaId) {
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
    });
    // Select Cidades
    $.get("/get-cidades", function (data) {
        const select = $("#cidade");
        $.each(data, function (index, tipo) {
            select.append(new Option(tipo.nome, tipo.id));
        });
    });
    // Cadastrar Endereco
    $('#salvar').click(function (event) {
        event.preventDefault();
        cadastrarEndereco(pessoaId); 
    });
});
