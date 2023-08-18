
$(document).on("click", ".excluir-pessoa", function (e) {
    e.preventDefault();

    var id = $(this).data('id');
    var nome = $(this).data('nome');
    $('#nome-pessoa').text(nome);
    $('#formExcluir input[name="id"]').val(id);
    $('#ModalDeletar').modal('show');
});

$(document).on("submit", "#formExcluir", function (e) {
    e.preventDefault();
    var form = this;
    var id = $('input[name="id"]').val();
    function showError() {
        toastr.error('Ocorreu um erro ao excluir a Pessoa.');
    }
    $.ajax({
        url: '/delete-pessoas/' + id,
        type: 'DELETE',
        data: $(form).serialize(),
        success: function (response, status, xhr) {
            if (xhr.status === 204) {
                toastr.success('Pessoa excluída com sucesso!');
                $('#ModalDeletar').modal('hide');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                showError();
            }
        },
        error: function (xhr) {
            showError();
        },
        complete: function () {
            $('#ModalDeletar').modal('hide');
        }
    });
});