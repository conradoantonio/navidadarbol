base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

/*Carga una foto a una categoría*/
function cargarFoto(button) {
    var formData = new FormData($("form#form_cargar_foto")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_cargar_foto").attr('action'),
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
            $('#modal-cargar-fotos').modal('hide');
            button.children('i').hide();
            button.attr('disabled', false);
            //refreshTable(window.location.href);
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

/*Elimina una foto de la galería*/
function eliminarFoto(id,foto) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/fotos/eliminar'),
        data: {
            "id":id
        },
        success: function(data) {
            swal({
                title: "foto " +foto + " eliminado correctamente.",
                type: "success",
                showConfirmButton: true,
                timer: 3000,
            });
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando el foto " +foto+ ", porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

/*Elimina un color de una categoría*/
function eliminarFotoCategoria(cat_id, categoria_foto_id) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/eliminar_foto_categoria'),
        data:{
            "categoria_id":cat_id,
            "categoria_foto_id":categoria_foto_id
        },
        success: function(data) {
            swal.close();
            $('div#'+categoria_foto_id).remove();
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema salvando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

/*Lista los colores de una categoría en una galería*/
function cargarFotosCategoria(button, categoria_id) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/categoria_galeria_fotos'),
        data:{
            "categoria_id":categoria_id
        },
        success: function(data) {
            button.children('i.fa-info-circle').show();
            button.children('i.fa-spin').hide();
            button.attr('disabled', false);
            $('div#modal-ver-galeria').modal();
            addContentGalery($('#contenido_galeria'), data);
            $('[data-toggle="tooltip"]').tooltip();
        },
        error: function(xhr, status, error) {
            button.children('i.fa-info-circle').show();
            button.children('i.fa-spin').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema salvando este registro, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

/* Añade los colores disponibles a un select como galería */
function cargarColores(categoria_id, color_id) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/categoria_colores'),
        data: {
            "categoria_id":categoria_id,
            "color_id":color_id
        },
        success: function(data) {
            refreshSelect(data, $('select#color_id'));
        },
        error: function(xhr, status, error) {
            console.warn('Ha ocurrido un error al momento de obtener los colores de la categoría. Error: ' + xhr.status + ' (' + error + ')'  );
        }
    });
}

/* Añade los colores disponibles de una categoría como galería */
function addContentGalery (div, data) {
    div.children().remove();
    div.append(data);
}

/* Recarga el select con las nuevas categorías */
function refreshSelect(data, select) {
    select.children('option').remove();
    select.append('<option value="0" selected="selected">Seleccione una opción</option>');
    
    data.forEach(function (option) {
        select.append('<option value="'+option.id+'">'+option.color+'</option>');
    });
}
