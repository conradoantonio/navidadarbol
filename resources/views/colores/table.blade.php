<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Color</th>
            <th>Status</th>
            <th class="hide">Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($colores) > 0)
            @foreach($colores as $color)
                <tr>
                    <td>{{$color->id}}</td>
                    <td>{{$color->color}}</td>
                    <td>{!!$color->status == 1 ? '<span class="label label-success">Activo</span>' : '<span class="label label-important">Inactivo</span>' !!}</td>
                    <td class="hide">{{$color->foto}}</td>
                    <td>
                        <button type="button" class="btn btn-info editar_color">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger eliminar_color">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            Borrar
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
