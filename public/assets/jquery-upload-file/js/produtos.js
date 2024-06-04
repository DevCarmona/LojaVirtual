$(document).ready(function ()
{
    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/produtos/upload",
        fileName: "foto_produto",
        returnType: "json",
        onSuccess: function (files, data) {

            if (data.erro == 0) {
                $("#uploaded_image").append('<ul style="list-style: none; display: inline-block" ><li data-name="' + data.uploaded_data['file_name'] + '"><img src="' + BASE_URL + 'uploads/produtos/' + data.uploaded_data['file_name'] + '" width="80" class="img-thumbnail mb-2 mr-1"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_caminho + '"><a href="javascript:(void)" type="button" class="btn bg-danger d-block btn-icon text-white mx-auto mb-30 btn-remove" style="width: 50px;"><i class="fas fa-times"></i></a></li></ul>');
            } else {
                $("#erro_uploaded").html(data.mensagem);
            }
        },
    });


    $('#uploaded_image').on('click', '.btn-remove', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-danger text-white',
                cancelButton: 'btn bg-blue text-white mr-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Tem certeza da exclusão?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-exclamation-circle"></i>Excluir!',
            cancelButtonText: '<i class="fas fa-arrow-circle-left"></i>Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                var name = $(this).parent().data('name');
                var ul = $(this).closest('ul');

                $.ajax({
                    type: "post",
                    url:  BASE_URL + "restrita/produtos/deleteimg",
                    data: {name: name},
                    dataType: "json",
                    success: function (data) {
                        if (data.erro === 0) {
                            ul.remove();
                        }
                    }
                });              
            } else {
                return false;
            }
        })
    });

});