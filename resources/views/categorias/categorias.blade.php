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

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_cargado_fotos" id="modal-cargar-fotos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_cargado_fotos">Cargado de fotos</h4>
                </div>
                <form id="form_categorias" action="{{url('cargar_fotos_categorias/subir')}}" onsubmit="return false" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            {{-- <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div> --}}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria ID</label>
                                    <input type="text" class="form-control" id="categoria_id" name="categoria_id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="categoria_name">Categoria</label>
                                    <input type="text" class="form-control" id="categoria_name" name="categoria_name">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <select class="selectpicker form-control" id="color_id" name="scolor_id[]" data-live-search="true"  multiple>
                                        @foreach($colores as $color)
                                            <option value="{{$color->id}}">{{$color->color}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_color_categoria">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_galeria_colores" id="modal-ver-galeria">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_galeria_colores">Listado de colores disponibles</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="contenido_galeria">
                        {{-- @include('categorias.galeria') --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Asignar fotos a categorías</h2>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    {{-- <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto</button>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#categoria_dialogo" id="categorias_crud"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Categorías</button>
                    </div> --}}
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla-productos">
                            @include('categorias.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('/js/bootstrap-select.js')}}"></script>
<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/categoriasAjax.js') }}"></script>
<script src="{{ asset('js/validacionesCategoriasFoto.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').delegate('.asignar_colores','click', function() {
        $('#form_categorias div.form-group').removeClass('has-error');

        id = $(this).parent().siblings("td:nth-child(1)").text(),
        categoria = $(this).parent().siblings("td:nth-child(2)").text(),
        array_colores = $(this).parent().siblings("td:nth-child(3)").text(),

        $('select#color_id').selectpicker('val');
        $('select#color_id').selectpicker('val', JSON.parse(array_colores));
        $("h4#titulo_cargado_fotos").text('Asignar colores a categoría ' + categoria);
        $("#form_categorias input#categoria_id").val(id);
        $("#form_categorias input#categoria_name").val(categoria);

        $('div#modal-cargar-fotos').modal({
            keyboard: false,
            backdrop: 'static',
        });
    });

    $('body').delegate('.ver_colores','click', function() {
        $(this).children('i.fa-info-circle').hide();
        $(this).children('i.fa-spin').show();

        $(this).attr('disabled', true);
        categoria_id = $(this).parent().siblings("td:nth-child(1)").text();
        categoria = $(this).parent().siblings("td:nth-child(2)").text(),

        $("h4#titulo_galeria_colores").text('Colores disponibles para categoria ' + categoria);

        cargarColoresCategoria($(this), categoria_id);
    });

    $('body').delegate('#guardar_color_categoria','click', function() {
        var categoria_id = $("#form_categorias input#categoria_id").val();
        var categoria = $("#form_categorias input#categoria_name").val();
        var btn = $(this);
        var array_colores = $('select#color_id').val();
        if (array_colores === null || array_colores === undefined) {//Se confirma que realmente el usuario desea remover los colores de la categoría.
            swal({
                title: "No se ha seleccionado ningún color para la categoría <span style='color:#4dd0e1'>" + categoria + "</span>, ¿Desea continuar de todas formas?",
                text: "¡Ningún color será asignado a esta categoría!",
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
                asignarColor(btn, categoria_id, array_colores);
            });
            
        } else {
            asignarColor(btn, categoria_id, array_colores);
        }
    });

    $('body').delegate('.borrar_color_galeria','click', function() {
        var categoria_color_id = $(this).parent().attr('id');
        var cat_id = $(this).parent().attr('cat_id');
        var color = $(this).parent('div').children('a').attr('data-title');

        swal({
            title: "¿Realmente desea remover el color <span style='color:#4dd0e1'>" + color + "</span> de ésta categoría?",
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
            eliminarColorCategoria(cat_id, categoria_color_id);
        });
    });
    
</script>
@endsection