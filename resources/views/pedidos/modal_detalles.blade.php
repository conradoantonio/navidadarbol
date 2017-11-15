<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_detalles_pedido" id="detalles_pedido">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="titulo_detalles_pedido">Detalles del pedido</h2>
            </div>
            <div class="modal-body">
                <div class="row text-left" id="campos_detalles">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item active">Datos generales del pedido</li>
                            <li class="list-group-item"><span class="label_show">Número de orden: <span id="order_id"></span></span></li>
                            <li class="list-group-item" id="li_order_id_conekta"><span class="label_show">ID orden de conekta: <span id="order_id_conekta"></span></span></li>
                            <li class="list-group-item" id="li_order_id_paypal"><span class="label_show">ID orden de paypal: <span id="order_id_paypal"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Número de guía: <span id="order_num_guia"></span></span></li>
                            {{-- <li class="list-group-item"><span class="label_show">Costo de envío: <span id="order_costo_envio"></span></span></li> --}}
                            <li class="list-group-item"><span class="label_show">Estatus: <span id="order_status">Pagado</span></span></li>
                            <li class="list-group-item"><span class="label_show">Fecha y hora de pago: <span id="order_date"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Cliente: <span id="order_client"></span></span></li>
                        </ul>

                        <ul class="list-group">
                            <li class="list-group-item active">Productos</li>
                            <li class="list-group-item">
                                <div class="table-responsive">
                                    <table id="detalle_pedido" class="table table-responsive">
                                        <thead>
                                            <th style="text-align: center;">Producto</th>
                                            <th style="text-align: center;">Color</th>
                                            <th style="text-align: center;">Ancho</th>
                                            <th style="text-align: center;">Dimensiones</th>
                                            <th style="text-align: center;">Puntas</th>
                                            <th style="text-align: center;">Precio unitario</th>
                                            <th style="text-align: center;">Cantidad</th>
                                            <th style="text-align: center;">Subtotal</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-group">
                            <li class="list-group-item active">Contacto</li>
                            <li class="list-group-item" id="li_cliente_conekta"><span class="label_show">ID cliente de conekta: <span id="customer_id_conekta"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Cliente: <span id="customer_name"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Email: <span id="customer_email"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Teléfono: <span id="customer_phone"></span></span></li>
                        </ul>

                        <ul class="list-group">
                            <li class="list-group-item active">Dirección</li>
                            <li class="list-group-item"><span class="label_show">Receptor: <span id="recibidor"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Teléfono: <span id="phone"></span></span></li>
                            <li class="list-group-item"><span class="label_show">País: <span id="country"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Estado: <span id="state"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Ciudad: <span id="city"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Código Postal: <span id="postal_code"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Calle: <span id="street"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Entre calle(s): <span id="between"></span></span></li>
                            <li class="list-group-item" id="li_no_int"><span class="label_show">Número interior: <span id="no_int"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Número exterior: <span id="no_ext"></span></span></li>
                        </ul>
                    </div>
                </div>
                <div class="row hide" id="load_bar">
                    <span><i class="fa fa-cloud-download fa-7x" aria-hidden="true"></i></span><br>
                    <h3>Cargando información de pedidos, espere.</h3>
                    <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-6 col-md-push-3 col-md-pull-3">
                        <div class="progress transparent progress-large progress-striped active no-radius no-margin">
                            <div data-percentage="100%" class="progress-bar progress-bar-success animate-progress-bar"></div>       
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