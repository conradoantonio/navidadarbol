base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

/*Carga una foto a una categoría*/
function enviarNotificacion(form,btn) {
    var formData = new FormData($(form)[0]);
    $.ajax({
        method: "POST",
        url: $(form).attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            swal({
                title: "Notificacion enviada.",
                type: "success",
                showConfirmButton: true,
            });
            $('#modal-cargar-fotos').modal('hide');
            btn.children('i').hide();
            btn.attr('disabled', false);
            //refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            btn.children('i').hide();
            btn.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema salvando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
