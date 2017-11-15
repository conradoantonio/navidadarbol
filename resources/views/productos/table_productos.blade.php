<table class="table" id="example3">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th class="hide">Categoria ID</th>
            <th>Categoria</th>
            <th>Altura</th>
            <th class="hide">Puntas</th>
            <th class="hide">Ancho</th>
            <th>Peso empaque</th>
            <th class="hide">Dimensiones empaque</th>
            <th class="hide">Armado ID</th>
            <th>Armado</th>
            <th>Secciones</th>
            <th class="hide">Pata soporte ID</th>
            <th>Pata Soporte</th>
            <th>Precio $</th>
            <th class="hide">Agotado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($productos) > 0)
            @foreach($productos as $producto)
                <tr class="" id="{{$producto->id}}">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input id="checkbox{{$producto->id}}" type="checkbox" class="checkDelete" value="1">
                            <label for="checkbox{{$producto->id}}"></label>
                        </div>
                    </td>
                    <td>{{$producto->id}}</td>
                    <td class="hide">{{$producto->categoria_id}}</td>
                    <td>{{$producto->categoria}}</td>
                    <td>{{$producto->altura}}</td>
                    <td class="hide">{{$producto->puntas}}</td>
                    <td class="hide">{{$producto->ancho}}</td>
                    <td>{{$producto->peso_empaque}}</td>
                    <td class="hide">{{$producto->dimensiones_empaque}}</td>
                    <td class="hide">{{$producto->armado_id}}</td>
                    <td>{{$producto->armado}}</td>
                    <td>{{$producto->secciones}}</td>
                    <td class="hide">{{$producto->pata_soporte_id}}</td>
                    <td>{{$producto->pata_soporte}}</td>
                    <td>{{$producto->precio}}</td>
                    <td class="hide">{{$producto->agotado}}</td>
                    <td>
                        <button type="button" class="btn btn-info editar_producto">Editar</button>
                        <button type="button" class="btn btn-danger eliminar_producto">Borrar</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>