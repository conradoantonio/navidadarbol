<table class="table" id="categoria">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria producto</th>
            <th>Costo envío</th>
            <th>Monto mínimo envío gratuito</th>
            <th>Tarifa de envío</th>
            <th class="hide">Foto categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($categorias) > 0)
            @foreach($categorias as $categoria)
                <tr class="" id="{{$categoria->id}}">
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->categoria}}</td>
                    <td>{!! $categoria->costo_envio == 1 ? '<span class="label label-info">Si</span>' : '<span class="label label-default">No</span>' !!}</td>
                    <td>{{$categoria->monto_minimo_envio}}</td>
                    <td>{{$categoria->tarifa_envio}}</td>
                    <td class="hide">{{$categoria->foto}}</td>
                    <td>
                        <button type="button" class="btn btn-info editar_categoria">Editar</button>
                        <button type="button" class="btn btn-danger eliminar_categoria">Borrar</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
               