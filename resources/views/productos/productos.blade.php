@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
img#imagen_categoria {
    width: 300px;
}
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_tipo_categoria" id="categoria_dialogo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_tipo_categoria">Categorías</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="tab-01">
                                <li class="active"><a href="#tabTablaCategoria">Tabla categorias</a></li>
                                <li><a href="#tabNuevaCategoria">Nueva categoría</a></li>
                            </ul>
                            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabTablaCategoria">
                                    <button type="button" class="btn btn-primary" id="nueva_categoria"><i class="fa fa-plus" aria-hidden="true"></i> Nueva categoría</button>
                                    <h3>Tabla de categorías disponibles: </h3>
                                    <div class="table-responsive" id="tabla-categorias">
                                        @include('productos.table_categorias')
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabNuevaCategoria">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form enctype="multipart/form-data" action="" method="POST" onsubmit="return false;" autocomplete="off" id="form_tipos">
                                                <div class="row">

                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="alert alert-info alert-dismissible text-left" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                                            <strong>Nota: </strong><br>
                                                            - Sólo introduzca números con un máximo de dos decimales sin el símbolo de peso ($).<br>
                                                            - En caso de que no haya costo de envío y/o tarifa de envío porfavor llene los campos con un 0. <br>
                                                            - Solo se permiten subir imágenes con formato jpg, png, jpeg y gif con un tamaño menor a 5mb. <br>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                                                    <div class="col-sm-6 col-xs-12 hidden">
                                                        <div class="form-group">
                                                            <label for="id">ID</label>
                                                            <input type="text" class="form-control" id="tipo_producto_id" name="tipo_producto_id">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tipo_producto">Categoría</label>
                                                            <input type="text" class="form-control" id="tipo_producto" name="tipo_producto" placeholder="Categoría">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12" style="padding-bottom: 20px;">
                                                        <label for="costo_envio">Costo envío</label>
                                                        <div class="row-fluid">
                                                            <div class="checkbox check-primary">
                                                                <input id="costo_envio" name="costo_envio" type="checkbox">
                                                                <label for="costo_envio" style="padding-left:0px;"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                                                           
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="monto_minimo_envio">Monto mínimo para envío gratuito</label>
                                                            <input type="text" class="form-control" id="monto_minimo_envio" name="monto_minimo_envio" placeholder="Ej: 189.50">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="tarifa_envio">Tarifa de envío</label>
                                                            <input type="text" class="form-control" id="tarifa_envio" name="tarifa_envio" placeholder="Ej: 59">
                                                        </div>
                                                    </div>

                                                    <div id="input_foto_producto" class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="imagen_categoria">Foto</label>
                                                            <input type="file" class="form-control" id="imagen_categoria" name="imagen_categoria">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="imagen_categoria">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Foto actual</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary" id="guardar_categoria">
                                                    <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                                    Guardar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_producto" id="formulario_producto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_producto">Nuevo producto</h4>
                </div>
                @include('productos.formulario')
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de productos</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="importar-excel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Importar desde Excel</h4>
                </div>
                @include('productos.importar_productos')
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_importar_categoria" id="importar-excel-categorias">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_importar_categoria">Importar desde Excel</h4>
                </div>
                <form method="POST" action="{{url('productos/importar_categorias')}}" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="{{url('')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="alert alert-info alert-dismissible text-justify" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Instrucciones de uso: </strong><br>
                                    Para importar categorías a través de Excel, los datos deben estar acomodados como se describe a continuación: <br>
                                    Los campos de la primera fila de la hoja de excel deben de ir los campos llamados 
                                    <strong>categoria, costo_envio, monto_minimo_envio, tarifa_envio</strong>, posteriormente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de las categorías. <br>
                                    <br><strong>Nota: </strong>
                                    <br>- En el caso de la columna "costo_envio", si hay costo de envío poner "si", de lo contrario escribir "no".
                                    <br>- Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd>.
                                    <br>- Las categorías repetidas en el excel no serán creadas ni alteradas.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <input type="file" id="archivo-excel-categorias" class="form-control" name="archivo-excel-categorias">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="enviar-excel-categorias">Importar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-info {{count($productos) ? '' : 'hide'}}" id="exportar_productos_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar productos</button>
                        <button type="button" class="btn btn-danger {{count($productos) ? '' : 'hide'}}" id="eliminar_multiples_productos"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar productos</button>

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importar-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar productos</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto</button>
                        <button type="button" class="btn btn-default" {{-- data-toggle="modal" data-target="#categoria_dialogo" --}} id="categorias_crud"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Categorías</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#importar-excel-categorias"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar categorias</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla-productos">
                            @include('productos.table_productos')
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
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/productosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesProductos.js') }}"></script>
<script src="{{ asset('js/validacionesProductoCategoria.js') }}"></script>
<script type="text/javascript">

/**
 *=====================================================================================================================================================
 *=                                         Empiezan las funciones relacionadas al crud de tipos de productos                                         =
 *=====================================================================================================================================================
 */
$('body').delegate('button#categorias_crud','click', function() {
    $("#form_tipos input#costo_envio").prop('checked', false);
    $('#form_tipos input.form-control').val('');
    $('#form_tipos div.form-group').removeClass('has-error');
    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/guardar_tipo_producto')}}");
    $('a[href="#tabTablaCategoria"]').tab('show');
    $('a[href="#tabNuevaCategoria"]').text('Nueva categoría');
    $("div#imagen_categoria").hide();
    $('#categoria_dialogo').modal({
        keyboard: false
    });
});

$('body').delegate('button#nueva_categoria','click', function() {
    $("#form_tipos input#costo_envio").prop('checked', false);
    $('#form_tipos div.form-group').removeClass('has-error');
    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/guardar_tipo_producto')}}");
    $('#form_tipos input.form-control').val('');
    $("div#imagen_categoria").hide();
    $('a[href="#tabNuevaCategoria"]').text('Nueva categoría').tab('show');
});


$('body').delegate('button.editar_categoria','click', function() {
    $('#form_tipos div.form-group').removeClass('has-error');

    tipo_producto_id = $(this).parent().siblings("td:nth-child(1)").text(),
    tipo_producto = $(this).parent().siblings("td:nth-child(2)").text(),
    costo_envio = $(this).parent().siblings("td:nth-child(3)").text(),
    monto_minimo_envio = $(this).parent().siblings("td:nth-child(4)").text(),
    tarifa_envio = $(this).parent().siblings("td:nth-child(5)").text();
    imagen_categoria = $(this).parent().siblings("td:nth-child(6)").text();

    $("#form_tipos").get(0).setAttribute('action', "{{url('tipo_producto/editar_tipo_producto')}}");
    $("#form_tipos input#tipo_producto_id").val(tipo_producto_id);
    $("#form_tipos input#tipo_producto").val(tipo_producto);
    $("#form_tipos input#costo_envio").prop('checked',costo_envio == 'Si' ? true : false );
    $("#form_tipos input#monto_minimo_envio").val(monto_minimo_envio);
    $("#form_tipos input#tarifa_envio").val(tarifa_envio);

    $('div#imagen_categoria').children().children().children().remove('img#imagen_categoria');
    $('div#imagen_categoria').children().children().append(
        "<img src='<?php echo asset('');?>/"+imagen_categoria+"' class='img-responsive img-thumbnail' alt='Responsive image' id='imagen_categoria'>"
    );
    $("div#imagen_categoria").show();

    $('a[href="#tabNuevaCategoria"]').text('Editar categoría').tab('show');
});

$('body').delegate('button.eliminar_categoria','click', function() {
    var id = $(this).parent().siblings("td:nth-child(1)").text();
    var nombre = $(this).parent().siblings("td:nth-child(2)").text();
    var token = $("#token").val();

    swal({
        title: "¿Realmente desea eliminar la categoría <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarTipoProducto(id,token);
    });
    
});


/**
 *=============================================================================================================================================
 *=                                        Empiezan las funciones relacionadas a la tabla de productos                                        =
 *=============================================================================================================================================
 */

$('#formulario_producto').on('hidden.bs.modal', function (e) {
    $('#formulario_producto div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $("#formulario_producto input#oferta").prop('checked',false);
});

$('#formulario_producto').on('shown.bs.modal', function () {
    categoria_id = $('select#subcategoria_id').attr('categoria-id');
    $("#formulario_producto select#subcategoria_id").val(categoria_id);
});

$('body').delegate('button#exportar_productos_excel','click', function() {
    fecha_inicio = false;
    fecha_fin = false;
    window.location.href = "<?php echo url();?>/productos/exportar_productos/"+fecha_inicio+"/"+fecha_fin;
});

$('body').delegate('button#nuevo_producto','click', function() {
    $('select.form-control').val(0);
    $('input.form-control').val('');
    $("#formulario_producto input#agotado").prop('checked', false);
    $('div#foto_producto').hide();
    $("h4#titulo_form_producto").text('Nuevo producto');
    $("form#form_producto").get(0).setAttribute('action', '<?php echo url();?>/productos/guardar');
});

$('body').delegate('.editar_producto','click', function() {
    $('input.form-control').val('');

    id = $(this).parent().siblings("td:nth-child(2)").text(),
    categoria_id = $(this).parent().siblings("td:nth-child(3)").text(),
    //categoria = $(this).parent().siblings("td:nth-child(4)").text(),
    altura = $(this).parent().siblings("td:nth-child(5)").text(),
    puntas = $(this).parent().siblings("td:nth-child(6)").text(),
    ancho = $(this).parent().siblings("td:nth-child(7)").text(),
    peso_empaque = $(this).parent().siblings("td:nth-child(8)").text(),
    dimensiones_empaque = $(this).parent().siblings("td:nth-child(9)").text(),
    armado_id = $(this).parent().siblings("td:nth-child(10)").text(),
    //armado = $(this).parent().siblings("td:nth-child(11)").text(),
    secciones = $(this).parent().siblings("td:nth-child(12)").text(),
    pata_soporte_id = $(this).parent().siblings("td:nth-child(13)").text(),
    //pata_soporte = $(this).parent().siblings("td:nth-child(14)").text(),
    precio = $(this).parent().siblings("td:nth-child(15)").text(),
    agotado = $(this).parent().siblings("td:nth-child(16)").text(),
    token = $('#token').val();

    $("h4#titulo_form_producto").text('Editar producto');
    $("form#form_producto").get(0).setAttribute('action', '{{url('productos/editar')}}');
    $("#formulario_producto input#id").val(id);
    $("#formulario_producto select#categoria_id").val(categoria_id);
    $("#formulario_producto input#altura").val(altura);
    $("#formulario_producto input#puntas").val(puntas);
    $("#formulario_producto input#ancho").val(ancho);
    $("#formulario_producto input#peso_empaque").val(peso_empaque);
    $("#formulario_producto input#dimensiones_empaque").val(dimensiones_empaque);
    $("#formulario_producto select#armado_id").val(armado_id);
    $("#formulario_producto input#secciones").val(secciones);
    $("#formulario_producto select#pata_soporte_id").val(pata_soporte_id);
    $("#formulario_producto input#precio").val(precio);
    $("#formulario_producto input#agotado").prop('checked',agotado == 1 ? true : false );

    $('#formulario_producto').modal();
});

$('body').delegate('#eliminar_multiples_productos','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar los <span style='color:#F8BB86'>" + checking.length + "</span> productos seleccionados?",
            text: "¡Esta acción no podrá deshacerse!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            var token = $("#token").val();
            eliminarMultiplesProductos(checking, token);
        });
    }
});


$('body').delegate('.eliminar_producto','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(3)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar al producto <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarProducto(id,token);
    });
});
</script>
@endsection