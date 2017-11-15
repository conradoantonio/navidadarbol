<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria producto</th>
            <th class="hide">Array colores</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($categorias) > 0)
            @foreach($categorias as $categoria)
                <tr id="{{$categoria->id}}">
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->categoria}}</td>
                    <td class="hide">{{$categoria->array_colores}}</td>
                    <td>
                        <button type="button" class="btn btn-success asignar_colores">
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                            Asigar colores
                        </button>
                        <button type="button" class="btn btn-info ver_colores">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true" style="display: none"></i>
                            <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            Ver colores
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
