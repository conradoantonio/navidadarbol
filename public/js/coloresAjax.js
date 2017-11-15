base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

function cargarColor(button) {
    var formData = new FormData($("form#form_colores")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_colores").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            swal({
                title: "Registro salvado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#modal-cargar-color').modal('hide');
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema salvando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarcolor(id,color) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/colores/eliminar'),
        data: {
            "id":id
        },
        success: function(data) {
            swal({
                title: "Color " +color + " eliminado correctamente.",
                type: "success",
                showConfirmButton: true,
                timer: 3000,
            });
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando el color " +color+ ", porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#tabla-colores').fadeOut();
    $('div#tabla-colores').empty();
    $('div#tabla-colores').load(url, function() {
        $('div#tabla-colores').fadeIn();
        $("table#example3").dataTable();
    });
}
