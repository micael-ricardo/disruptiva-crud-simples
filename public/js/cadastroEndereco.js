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
// Cadastrar ou Atualizar Endereco
function salvarEndereco(pessoaId) {
    const dadosEnderecoCadastro = $('#endereco-form').serialize() + '&pessoa_id=' + pessoaId;
    if (pessoaId) {
        $.post('/cadastrar-endereco', dadosEnderecoCadastro, function (response) {
            toastr.success('Cadastrado com sucesso!');
            window.location.href = '/';
        }).fail(function (xhr, textStatus, errorThrown) {
            var errorMessage = xhr.responseJSON.message;
            if (xhr.status === 422) {
                toastr.error(errorMessage);
            } else {
                toastr.error('Ocorreu um erro ao cadastrar endereço. Por favor, tente novamente mais tarde.');
            }
        });
    }
}
function atualizarEndereco(enderecoId, pessoaUpdateId) {
    const dadosEndereco = $('#endereco-form').serialize() + '&pessoa_id=' + pessoaUpdateId;
    if (!validarFormularioEndereco()) {
        return;
    } else {
        if (enderecoId) {
            $.ajax({
                url: "/atualizar-endereco/" + enderecoId,
                type: "PUT",
                data: dadosEndereco,
                success: function (response) {
                    toastr.success('Endereço atualizado com sucesso!');
                    window.location.href = '/';
                },
                error: function (xhr, textStatus, errorThrown) {
                    var errorMessage = xhr.responseJSON.message;
                    if (xhr.status === 422) {
                        toastr.error(errorMessage);
                    }
                }
            });
        } else {
            if (pessoaUpdateId) {
                $.post('/cadastrar-endereco', dadosEndereco, function (response) {
                    toastr.success('Cadastrado com sucesso!');
                    window.location.href = '/';
                }).fail(function (xhr, textStatus, errorThrown) {
                    var errorMessage = xhr.responseJSON.message;
                    if (xhr.status === 422) {
                        toastr.error(errorMessage);
                    } else {
                        toastr.error('Ocorreu um erro ao cadastrar endereço. Por favor, tente novamente mais tarde.');
                    }
                });
            }
        }
    }
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

    // limpar todos os campos de endereço caso apage o cep 
    $('#cep').on('blur', function () {
        const cep = $(this).val();
        if (cep === '') {
            $('#logradouro').val('');
            $('#numero').val('');
            $('#bairro').val('');
            $('select').prop('selectedIndex', 0);
        }
    });

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
    // Cadastrar ou Atualizar Endereco
    $('#salvar').click(function (event) {
        event.preventDefault();
        const pessoaUpdateId = $("#pessoa_id").val();
        const enderecoId = $("#endereco_id").val();
        salvarEndereco(pessoaId);
        atualizarPessoa(function (success) {
            if (success) {
                atualizarEndereco(enderecoId, pessoaUpdateId)
            }
        });
    });
});
