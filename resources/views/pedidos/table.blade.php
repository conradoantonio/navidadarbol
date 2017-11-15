<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID orden</th>
            <th>Fecha pago</th>
            <th>Total</th>
            <th>Cliente</th>
            <th>Método de pago</th>
            <th>Num. Guía</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($pedidos))
            @foreach($pedidos as $pedido)
                <tr class="" id="{{$pedido->id}}">
                    <td>{{$pedido->id}}</td>
                    <td>{{$pedido->created_at}}</td>
                    <td>{{'$'.$pedido->costo_total/100}}</td>
                    <td>{{$pedido->nombre_cliente}}</td>
                    <td>
                        {!! ($pedido->tipo_orden == 'card' ? "<span class='label label-success'>Tarjeta</span>" : 
                                ( $pedido->tipo_orden == 'oxxo' ? "<span class='label label-warning'>Oxxo Pay</span>" : 
                                    ($pedido->tipo_orden == 'paypal' ? "<span class='label label-info'>Paypal</span>" : "<span class='label label-default'>Desconocido</span>")
                                )
                            ) 
                        !!}
                    </td>
                    <td>{!!$pedido->num_guia ? "<span class='label label-success'>$pedido->num_guia</span>" : "<span class='label label-default'>Sin asignar</span>" !!}</td>
                    <td>
                        <button type='button' class='btn btn-default asignar_num_guia'>
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Num. Guía
                        </button>
                        <button type="button" class="btn btn-info detalle_producto">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            Detalles
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>