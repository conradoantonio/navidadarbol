base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

/*Asigna colores a una categoría*/
function asignarColor(button, categoria_id, array_colores) {
    button.children('i').show();
    button.attr('disabled', true);
    $.ajax({
        method: "POST",
        url: base_url.concat('/asignar_color_categorias/actualizar'),
        data: {
            "categoria_id":categoria_id,
            "array_colores":array_colores
        },
        success: function(data) {
            swal({
                title: "Registro salvado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#modal-cargar-fotos').modal('hide');
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

/*Lista los colores de una categoría en una galería*/
function cargarColoresCategoria(button, categoria_id) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/asignar_color_categorias/listar_colores'),
        data:{
            "categoria_id":categoria_id
        },
        success: function(data) {
            button.children('i.fa-info-circle').show();
            button.children('i.fa-spin').hide();
            button.attr('disabled', false);
            $('div#modal-ver-galeria').modal();
            addContentGalery($('#contenido_galeria'), data);
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

/*Elimina un color de una categoría*/
function eliminarColorCategoria(cat_id, categoria_color_id) {
    $.ajax({
        method: "POST",
        url: base_url.concat('/asignar_color_categorias/eliminar'),
        data:{
            "categoria_id":cat_id,
            "categoria_color_id":categoria_color_id
        },
        success: function(data) {
            swal.close();
            console.log(data.colores[0].array_colores);
            $('tr#'+cat_id).children('td').siblings("td:nth-child(3)").text(JSON.stringify(data.colores[0].array_colores));
            $('div#'+categoria_color_id).remove();
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

/*Refresca la tabla con el nuevo contenido de la base de datos*/
function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#tabla-productos').fadeOut();
    $('div#tabla-productos').empty();
    $('div#tabla-productos').load(url, function() {
        $('div#tabla-productos').fadeIn();
        $("table#example3").dataTable();
    });
}

/* Añade los colores disponibles como galería */
function addContentGalery (div, data) {
    div.children().remove();
    div.append(data);
}
