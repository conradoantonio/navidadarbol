base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista

/*Función para cargar el excel de productos a la base de datos*/
function subirProducto(button) {
    var formData = new FormData($("form#form_producto")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_producto").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#formulario_producto').modal('hide');
            var tabla_id = 'example3';
            var contenedor_tabla = $('div#tabla-productos');
            refreshTableProducts(window.location.href+'/tabla', tabla_id, contenedor_tabla);
            setTimeout( function(){ mostrarOcultarBotones($('#exportar_productos_excel, #eliminar_multiples_productos'), 'example3') }, 1000);
        },
        error: function(xhr, status, error) {
            $('div#formulario_producto').modal('hide');
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema cargando este archivo, porfavor, revise que los datos cargados en el excel sean correctos y trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarProducto(id,token) {
    url = base_url.concat('/productos/eliminar');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function() {
            swal.close();
            var tabla_id = 'example3';
            var contenedor_tabla = $('div#tabla-productos');
            refreshTableProducts(window.location.href+'/tabla', tabla_id, contenedor_tabla);
            setTimeout( function(){ mostrarOcultarBotones($('#exportar_productos_excel, #eliminar_multiples_productos'), 'example3') }, 1000);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este producto, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarMultiplesProductos(checking, token) {
    //console.info(checking);
    url = base_url.concat('/productos/eliminar_multiples');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "checking":checking,
            "_token":token
        },
        success: function(data) {
            var tabla_id = 'example3';
            var contenedor_tabla = $('div#tabla-productos');
            refreshTableProducts(window.location.href+'/tabla', tabla_id, contenedor_tabla);
            swal.close();
            setTimeout(function(){ mostrarOcultarBotones($('#exportar_productos_excel, #eliminar_multiples_productos'), 'example3') }, 1000);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando los productos seleccionados, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function eliminarTipoProducto(id,token) {
    url = base_url.concat('/tipo_producto/eliminar_tipo_producto');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "tipo_producto_id":id,
            "_token":token
        },
        success: function(response) {
            swal({
                title: "Registro eliminado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            refreshTable(window.location.href);
            recargarSelect(response);
            //dibujarTabla(response);
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este registro, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function actualizarCategoria(button) {
    var formData = new FormData($("form#form_tipos")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_tipos").attr('action'),
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
            recargarSelect(data);
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

/*function actualizarCategoria(button) {
    $.ajax({
        method: "POST",
        url: $("form#form_tipos").attr('action'),
        data: $("form#form_tipos").serialize(),
        //processData: false,
        success: function(data) {
            swal({
                title: "Registro salvado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            button.children('i').hide();
            button.attr('disabled', false);
            //$('div#categoria_dialogo').modal('hide');
            recargarSelect(data);
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
}*/

/*Función para cargar el excel de productos a la base de datos*/
function cargarExcelProductos(button) {
    var formData = new FormData($("form#form-subir-productos-excel")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form-subir-productos-excel").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            swal({
                title: "Registros de excel cargados exitosamente.",
                type: "success",
                showConfirmButton: true,
                timer: 2000,
            });
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#importar-excel').modal('hide');
            var tabla_id = 'example3';
            var contenedor_tabla = $('div#tabla-productos');
            refreshTableProducts(window.location.href+'/tabla', tabla_id, contenedor_tabla);
            setTimeout(function(){ mostrarOcultarBotones($('#exportar_productos_excel, #eliminar_multiples_productos'), 'example3') }, 1000);
        },
        error: function(xhr, status, error) {
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema cargando este archivo, porfavor, revise que los datos cargados en el excel sean correctos y trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function refreshTableProducts(url, tabla_id, contenedor) {
    var table = $("table#"+tabla_id).dataTable();
    table.fnDestroy();
    $("table#"+tabla_id).fadeOut();
    //tabla.empty();
    contenedor.load(url, function() {
        $("table#"+tabla_id).dataTable();
        setTimeout(function(){ $("table#"+tabla_id).fadeIn('1000'); }, 500);
    });
}

function refreshTable(url) {
    var table = $("table#categoria").dataTable();
    table.fnDestroy();
    $('div#tabla-categorias').fadeOut();
    $('div#tabla-categorias').empty();
    $('div#tabla-categorias').load(url, function() {
        $('div#tabla-categorias').fadeIn();
        setTimeout(function(){ $('a[href="#tabTablaCategoria"]').tab('show'); }, 500);
        $("table#categoria").dataTable();
    });
}

function recargarSelect(data) {
    $('select#categoria_id option').remove();
    $('select#categoria_id').append('<option value="0" selected="selected">Seleccione una opción</option>');
    
    data.forEach(function (option) {
        $('select#categoria_id').append('<option value="'+option.id+'">'+option.categoria+'</option>');
    });
}

function mostrarOcultarBotones(buttons, table_id) {
    var table = $('#'+table_id).DataTable();
    if (table.fnSettings().aoData.length > 0) {
        buttons.removeClass('hide');
    } else {
        buttons.addClass('hide');
    }
}