<form id="form_producto" action="" enctype="multipart/form-data" onsubmit="return false" method="POST" autocomplete="off">
    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-6 col-xs-12 hidden">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" name="id">
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select class="form-control" id="categoria_id" name="categoria_id">
                        <option value="0">Seleccione una opción</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="altura">Altura</label>
                    <input type="text" class="form-control" id="altura" name="altura" placeholder="Altura">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="puntas">Puntas</label>
                    <input type="text" class="form-control" id="puntas" name="puntas" placeholder="Puntas">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="ancho">Ancho</label>
                    <input type="text" class="form-control" id="ancho" name="ancho" placeholder="Ancho">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="peso_empaque">Peso empaque</label>
                    <input type="text" class="form-control" id="peso_empaque" name="peso_empaque" placeholder="Peso empaque">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="dimensiones_empaque">Dimensiones empaque</label>
                    <input type="text" class="form-control" id="dimensiones_empaque" name="dimensiones_empaque" placeholder="Dimensiones empaque">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="secciones">Secciones</label>
                    <input type="text" class="form-control" id="secciones" name="secciones" placeholder="Secciones">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="armado_id">Tipo de armado</label>
                    <select class="form-control" id="armado_id" name="armado_id">
                        <option value="0">Seleccione una opción</option>
                        @foreach($armados as $armado)
                            <option value="{{$armado->id}}">{{$armado->armado}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="pata_soporte_id">Tipo de pata/soporte</label>
                    <select class="form-control" id="pata_soporte_id" name="pata_soporte_id">
                        <option value="0">Seleccione una opción</option>
                        @foreach($patas_soportes as $pata_soporte)
                            <option value="{{$pata_soporte->id}}">{{$pata_soporte->pata_soporte}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12" style="padding-bottom: 20px;">
                <label for="agotado">Producto agotado</label>
                <div class="row-fluid">
                    <div class="checkbox check-primary">
                        <input id="agotado" name="agotado" type="checkbox">
                        <label for="agotado" style="padding-left:0px;"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="guardar_producto">
            <i class="fa fa-spinner fa-spin" style="display: none"></i>
            Guardar
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
</form>