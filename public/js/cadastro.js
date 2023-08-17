// Validar Email
function validar_email(email) {
    const regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?$/; 
    return regex.test(email);
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
});

// Limpar Campos
$(document).ready(function () {
    $('#limparCampos').click(function () {
        $('input[type="text"]').val('');
        $('input[type="password"]').val('');
        $('input[type="number"]').val('');
        $("input[type='radio']").prop("checked", false);
        $('select').prop('selectedIndex', 0);
    });
});

// CEP
$(document).ready(function () {
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
                        $("#rua").val(data.logradouro);
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
});
$(document).ready(function () {
    $('#cep').inputmask('99.999-999');
});

// Select TipoLogradouros
$(document).ready(function() {
    $.get("/get-tipos-logradouros", function(data) {
        const select = $("#tipo_logradouro");
        
        $.each(data, function(index, tipo) {
            select.append(new Option(tipo.nome, tipo.id));
        });
    });
});

// Select Cidades
$(document).ready(function() {
    $.get("/get-cidades", function(data) {
        const select = $("#cidade");
        
        $.each(data, function(index, tipo) {
            select.append(new Option(tipo.nome, tipo.id));
        });
    });
});