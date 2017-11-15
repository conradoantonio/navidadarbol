<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_asignar_num_guia" id="asignar_num_guia">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onsubmit="return false" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title_asignar_num_guia">Asignar número de guía</h4>
            </div>
            <form id="form_asignar_num_guia" action="{{url('pedidos/asignar_num_guia')}}" onsubmit="return false;" enctype="multipart/form-data" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        {!! csrf_field() !!}
                        <div class="col-sm-6 col-xs-12 hidden">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="order_id" name="order_id">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="id">Número de guía</label>
                                <input type="text" class="form-control" id="num_guia" name="num_guia" placeholder="Ej. 12345678901">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="id">Paquetería</label>
                                <input type="text" class="form-control" id="paqueteria" name="paqueteria" placeholder="Ej. DHL">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_asignar_num_guia">
                        Asignar
                        <i class="fa fa-spinner fa-spin" style="display: none"></i>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->