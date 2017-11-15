<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria producto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($categorias) > 0)
            @foreach($categorias as $categoria)
                <tr id="{{$categoria->id}}">
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->categoria}}</td>
                    <td>
                        <button type="button" class="btn btn-success agregar_foto">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true" style="display: none"></i>
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Asigar fotos
                        </button>
                        <button type="button" class="btn btn-info ver_fotos">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true" style="display: none"></i>
                            <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            Ver fotos
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
