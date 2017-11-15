@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}" type="text/css"/>
<style type="text/css">
    th {
        text-align: center;
    }
    form.dropzone{
        border-style: dashed;
        border-color: deepskyblue;
    }
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_cargado_fotos" id="modal-cargar-color">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_cargado_fotos">Cargado de fotos</h4>
                </div>
                <form id="form_colores" action="{{url('cargar_fotos_categorias/subir')}}" onsubmit="return false" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="color">Nombre color</label>
                                    <input type="text" class="form-control" id="color" name="color">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12" id="input_foto_producto">
                                <div class="form-group">
                                    <label for="foto-usuario">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="foto_tipo">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_foto">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de colores</h2>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_color" id="nuevo_color"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo color</button>
                        {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#categoria_dialogo" id="categorias_crud"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Categorías</button> --}}
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla-colores">
                            @include('colores.table')
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
<script src="{{ asset('js/coloresAjax.js') }}"></script>
<script src="{{ asset('js/validacionesColores.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').delegate('button#nuevo_color','click', function() {
        $("h4#titulo_cargado_fotos").text('Nuevo color');
        $('#form_colores div.form-group').removeClass('has-error');
        $("#form_colores").get(0).setAttribute('action', "{{url('colores/subir')}}");
        $('#form_colores input.form-control').val('');
        $("div#foto_tipo").hide();
        $('div#modal-cargar-color').modal();
    });

    $('body').delegate('.editar_color','click', function() {
        $('#form_colores div.form-group').removeClass('has-error');
        
        id = $(this).parent().siblings("td:nth-child(1)").text(),
        color = $(this).parent().siblings("td:nth-child(2)").text(),
        //status = $(this).parent().siblings("td:nth-child(3)").text(),
        foto = $(this).parent().siblings("td:nth-child(4)").text();

        $("#form_colores").get(0).setAttribute('action', "{{url('colores/editar')}}");

        $("h4#titulo_cargado_fotos").text('Editar color ' + color);
        $("#form_colores input#id").val(id);
        $("#form_colores input#color").val(color);

        $('div#foto_tipo').children().children().children().remove('img#foto_tipo');
        $('div#foto_tipo').children().children().append(
            "<img src='<?php echo asset('');?>/"+foto+"' class='img-responsive img-thumbnail' style='width:200px;' alt='Responsive image' id='foto_tipo'>"
        );

        $("div#foto_tipo").show();

        $('div#modal-cargar-color').modal();
    });

    $('body').delegate('.eliminar_color','click', function() {
        var id = $(this).parent().siblings("td:nth-child(1)").text();
        var color = $(this).parent().siblings("td:nth-child(2)").text();

        swal({
            title: "¿Realmente desea eliminar el color <span style='color:#F8BB86'>" + color + "</span>?",
            text: "¡No podrá deshacer esta acción, cuidado!",
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
            eliminarcolor(id,color);
        });
    });
</script>
@endsection