<form id="form-subir-productos-excel" method="POST" action="{{ url('productos/importar_productos') }}" onsubmit="return false" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="{{ url('') }}">
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                 <div class="alert alert-info alert-dismissible text-justify" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>Instrucciones de uso: </strong><br>
                    Para importar productos a través de Excel, los datos deben estar acomodados como se describe a continuación: <br>
                    Los campos de la primera fila de la hoja de excel deben de ir los campos llamados 
                    <strong>"Categorías, Altura, Puntas, Ancho, Peso de empaque, Dimensiones de empaque, Armado, Secciones, Pata Soporte y Precio"</strong>, posteriormente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de los productos.
                    <br><strong>Nota: </strong>
                    <br>- Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd> y los productos repetidos en el excel no serán creados.
                    <br>- Esta acción puede llevar hasta 1 minuto, porfavor espere y permanezca en esta ventana hasta que un mensaje sea mostrado en su pantalla.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <input class="form-control" type="file" id="archivo-excel" name="archivo-excel">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="enviar-excel">
            <i class="fa fa-spinner fa-spin" style="display: none"></i>
            Importar
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
</form>