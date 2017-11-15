@extends('admin.main')

@section('content')
{{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/> --}}
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
label.control-label{
    font-weight: bold;
}
table td.table-bordered{
    border-bottom: 1px solid gray!important;
    border-top: 1px solid gray!important;
}
span.label_show {
    display: block;
    font-weight: bold;
}
span.label_show span {
    font-weight: normal;
}
li.active{
    color: white;
}
</style>
<div class="text-center" style="margin: 20px;">

    @include('pedidos.modal_detalles')

    @include('pedidos.modal_num_guia')

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="asignar_estilista_label" id="asignar-estilista">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="asignar_estilista_label">Asignar estilista</h4>
                </div>
                <form id="form_asignar_estilista" action="{{url('/pedidos/asignar_estilista')}}" onsubmit="return false;" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="servicio_id" name="servicio_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Fecha inicio</label>
                                    <input type="text" class="form-control" id="start_datetime" name="start_datetime">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">Fecha final</label>
                                    <input type="text" class="form-control" id="end_datetime" name="end_datetime">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="estilista_id">Estilista</label>
                                    <select id="estilista_id" name="estilista_id" style="width:100%">
                                        <option value="0">Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-asignar-estilista">
                            Asignar
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Listado de pedidos</h2>

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla_pedidos">
                            @include('pedidos.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/pedidosAjax.js') }}"></script>
<script type="text/javascript">

$.fn.modal.Constructor.prototype.enforceFocus = function() {};//Esto corrige que el select2 pueda funcionar apropiadamente
var token = $("#token").val();

$('body').delegate('.detalle_producto','click', function() {
    var orden_id = $(this).parent().siblings("td:nth-child(1)").text();

    $('div#campos_detalles').addClass('hide');
    $('div#load_bar').removeClass('hide');
    $('#detalles_pedido').modal();
    obtenerInfoPedido(orden_id,token);
});

$('body').delegate('.asignar_num_guia','click', function() {
    $('input.form-control').val('');
    var order_id = $(this).parent().siblings("td:nth-child(1)").text();
    $('form#form_asignar_num_guia input#order_id').val(order_id);
    $('h4#title_asignar_num_guia').text('Número de guía para pedido con ID ' + order_id);
    $('div#asignar_num_guia').modal();

    
    /*var order_id = $(this).parent().siblings("td:nth-child(1)").text();
    var token = $('#token').val();
    swal({
        title: "Asignar guía",
        text: "Ingrese el nuevo número de guía para este pedido (se enviará un correo electrónico al usuario mostrando el número de guía asignado al pedido).",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        animation: "slide-from-top",
        inputPlaceholder: "Ej. 2345678901"
    },
    function(inputValue) {
        if (inputValue === false) return false;

        if (inputValue === "") {
            swal.showInputError("No se permite dejar este campo vacío");
            return false
        } else {
            asignarNumeroGuia(inputValue, order_id, token);
            return true;
        }
    });*/
});

$('body').delegate('button#btn_asignar_num_guia', 'click', function() {
    btn = $('button#btn_asignar_num_guia')
    
    paqueteria = $('input#paqueteria').val();
    num_guia = $('input#num_guia').val();

    if (paqueteria != '' && num_guia != '') {
        btn.children('i').show();
        btn.attr('disabled', true);
        asignarNumeroGuia(btn);
    } else {
        swal({
            type: "error",
            title: "<small>¡Error!</small>",
            text: "Necesita llenar ambos campos antes de continuar.",
            html: true
        });
    }
});

</script>
@endsection