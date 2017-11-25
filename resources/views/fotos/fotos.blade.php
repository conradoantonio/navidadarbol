@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{asset('/css/bootstrap-select.min.css')}}" type="text/css"/>
<style type="text/css">
    th {
        text-align: center;
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
                <form id="form_cargar_foto" action="" onsubmit="return false" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            {!! csrf_field() !!}
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria ID</label>
                                    <input type="text" class="form-control" id="categoria_id" name="categoria_id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control" id="color_id" name="color_id">
                                        <option value="">Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-dismissible text-left" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Nota: </strong><br>
                                    - Suba imágenes de 600x1000 px, ya que el sistema redimensionará automáticamente a estas medidas<br>
                                    - Solo se admiten archivos menores a 5mb
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12" id="input_foto_producto">
                                <div class="form-group">
                                    <label for="foto-usuario">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="div_foto">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_foto_categoria">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_galeria_fotos" id="modal-ver-galeria">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_galeria_fotos">Listado de fotos disponibles</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="contenido_galeria">
                        {{-- @include('fotos.galeria') --}}
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
                    <div class="grid-body">
                        <div class="table-responsive" id="tabla-productos">
                            @include('fotos.table')
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
<script src="{{ asset('js/fotosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesCategoriasFoto.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').delegate('.agregar_foto','click', function() {
        $('#div_foto').hide();
        $('#form_cargar_foto div.form-group').removeClass('has-error');
        $('#form_cargar_foto input.form-control').val('');
        $('#form_cargar_foto').attr('action', "{{url('agregar_foto_categoria')}}");

        id = $(this).parent().siblings("td:nth-child(1)").text(),
        categoria = $(this).parent().siblings("td:nth-child(2)").text(),
        
        cargarColores(id, 0);

        $("h4#titulo_cargado_fotos").text('Cargar foto a categoria ' + categoria);
        $("#form_cargar_foto input#categoria_id").val(id);
        $("#form_cargar_foto input#categoria_name").val(categoria);

        $('div#modal-cargar-fotos').modal({
            keyboard: false,
            backdrop: 'static',
        });
    });

    $('body').delegate('.ver_fotos','click', function() {
        $(this).children('i.fa-info-circle').hide();
        $(this).children('i.fa-spin').show();

        $(this).attr('disabled', true);
        categoria_id = $(this).parent().siblings("td:nth-child(1)").text();
        categoria = $(this).parent().siblings("td:nth-child(2)").text(),

        $("h4#titulo_galeria_fotos").text('Fotos disponibles para categoria ' + categoria);

        cargarFotosCategoria($(this), categoria_id);
    });

    

    $('body').delegate('.editar_foto_galeria','click', function() {
        $('#form_cargar_foto div.form-group').removeClass('has-error');
        $('#form_cargar_foto input.form-control').val('');
        $('#form_cargar_foto').attr('action', "{{url('editar_foto_categoria')}}");

        id = $(this).parent().attr('id'),
        categoria_id = $(this).parent().attr('cat_id'),
        color_id = $(this).parent().attr('color_id'),
        foto = $(this).parent().children('a').attr('href'),

        cargarColores(categoria_id, color_id);
        setTimeout(function(){ $('select#color_id').val(color_id) }, 1500);

        $('select#foto_id').selectpicker('val');
        $("h4#titulo_cargado_fotos").text('Cargar foto a categoria ' + categoria);
        $("#form_cargar_foto input#id").val(id);
        $("#form_cargar_foto input#categoria_id").val(categoria_id);
        $("#form_cargar_foto input#categoria_name").val(categoria);

        $('div#div_foto').children().children().children().remove('img#foto_tipo');
        $('div#div_foto').children().children().append(
            "<img src='"+foto+"' class='img-responsive img-thumbnail' style='width:200px;' alt='Responsive image' id='foto_tipo'>"
        );
        $('div#div_foto').show();

        $('div#modal-ver-galeria').modal('hide');
        setTimeout(function(){
            $('#modal-cargar-fotos').modal({
                keyboard: false,
                backdrop: 'static',
            })
        }, 500);
        
    });

    $('body').delegate('.borrar_foto_galeria','click', function() {
        var categoria_foto_id = $(this).parent().attr('id');
        var cat_id = $(this).parent().attr('cat_id');
        var foto = $(this).parent('div').children('a').attr('data-title');

        console.log(foto);
        swal({
            title: "¿Realmente desea remover la foto <span style='color:#4dd0e1'>" + foto + "</span> de ésta categoría?",
            text: "¡Cuidado!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonfoto: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            eliminarFotoCategoria(cat_id, categoria_foto_id);
        });
    });
    
</script>
@endsection