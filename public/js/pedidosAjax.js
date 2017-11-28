base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function obtenerInfoPedido(orden_id,token) {
    url = base_url.concat('/pedidos/obtener_info_pedido');
    $.ajax({
        method: "POST",
        url: url,
        data:{
            "id":orden_id,
            "_token":token
        },
        success: function(data) {
            console.info(data);

            $("table#detalle_pedido tbody").children().remove();
            $('li#li_order_id_conekta').hide();
            $('li#li_order_id_paypal').hide();
            $('li#li_cliente_conekta').hide();
            $('li#li_no_int').hide();

            var items = data.detalles;

            /*Datos generales*/
            $('span#order_id').text(data.id);


            if (data.conekta_order_id != null) {
                $('li#li_order_id_conekta').show();
                $('span#order_id_conekta').text(data.conekta_order_id);
            }

            if (data.paypal_order_id != null) {
                $('li#li_order_id_paypal').show();
                $('span#order_id_paypal').text(data.paypal_order_id);
            }

            $('span#order_num_guia').text(data.num_guia != null ? data.num_guia : 'Sin asignar');
            //$('span#order_costo_envio').text(data.costo_envio);

            $('span#order_status').text('Pagado');
            $('span#order_date').text(data.created_at);
            $('span#order_client').text(data.nombre_cliente);

            /*Datos de contacto*/
            if (data.customer_id_conekta != null) {
                $('li#li_cliente_conekta').show();
                $('span#customer_id_conekta').text(data.customer_id_conekta);
            }
            $('span#customer_name').text(data.nombre_cliente);
            $('span#customer_email').text(data.correo_cliente);
            $('span#customer_phone').text(data.telefono);

            /*Dirección*/
            $('span#recibidor').text(data.recibidor);
            $('span#phone').text(data.telefono);
            $('span#country').text(data.pais);
            $('span#state').text(data.estado);
            $('span#city').text(data.ciudad);
            $('span#postal_code').text(data.codigo_postal);
            $('span#street').text(data.calle);
            $('span#between').text(data.entre);
            if (data.num_int != null) {
                $('li#li_no_int').show();
                $('span#no_int').text(data.num_int);
            }
            $('span#no_ext').text(data.num_ext);

            /*Detalles de pedido (Productos)*/
            for (var key in items) {
                if (items.hasOwnProperty(key)) {
                    $("table#detalle_pedido tbody").append(
                        '<tr>'+
                            '<td class="text-center">'+items[key].nombre_producto+'</td>'+
                            '<td class="text-center"><img style="width: 30px;" src='+items[key].foto+'></td>'+
                            '<td class="text-center">'+(items[key].ancho)+'</td>'+
                            '<td class="text-center">'+(items[key].dimensiones_empaque)+'</td>'+
                            '<td class="text-center">'+(items[key].puntas)+'</td>'+
                            '<td class="text-center">$'+(items[key].precio / 100)+'</td>'+
                            '<td class="text-center">'+(items[key].cantidad)+'</td>'+
                            '<td class="text-center">$'+((items[key].precio * items[key].cantidad) / 100)+'</td>'+
                        '</tr>'
                    );
                }
            }

            $("table#detalle_pedido tbody").append(
                '<tr>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center bold">Costo envío</td>'+
                    '<td class="text-center">$'+(data.costo_envio/100)+'</td>'+
                '</tr>'
            );

            $("table#detalle_pedido tbody").append(
                '<tr>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center"></td>'+
                    '<td class="text-center bold">Costo total</td>'+
                    '<td class="text-center">$'+(data.costo_total/100)+'</td>'+
                '</tr>'
            );

            $('div#campos_detalles').removeClass('hide');
            $('div#load_bar').addClass('hide');
        },
        error: function(xhr, status, error) {
            $('#detalles_pedido').modal('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema obteniendo los detalles de este pedido, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function asignarNumeroGuia(button) {
    var formData = new FormData($("form#form_asignar_num_guia")[0]);
    $.ajax({
        method: "POST",
        url: $("form#form_asignar_num_guia").attr('action'),
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data) {
            button.children('i').hide();
            button.attr('disabled', false);
            $('div#asignar_num_guia').modal('hide');
            refreshTable(window.location.href);
        },
        error: function(xhr, status, error) {
            $('div#asignar_num_guia').modal('hide');
            button.children('i').hide();
            button.attr('disabled', false);
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema asignando el número de guía a este pedido, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function refreshTable(url) {
    var table = $("table#example3").dataTable();
    table.fnDestroy();
    $('div#tabla_pedidos').fadeOut();
    $('div#tabla_pedidos').empty();
    $('div#tabla_pedidos').load(url, function() {
        $('div#tabla_pedidos').fadeIn();
        $("table#example3").dataTable({
            "aaSorting": [[ 0, "desc" ]]
        });
    });
}