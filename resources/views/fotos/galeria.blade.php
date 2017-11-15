<div id="galeria" class="text-center" style="margin-top: 20px;">
	@if (count($colores)) 
		@foreach ($colores as $color) 
			<div id="{{$color->categoria_foto_id}}" cat_id="{{$color->categoria_id}}" color_id="{{$color->color_id}}" class='col-sm-3 text-center color'>
				<a id="{{$color->categoria_foto_id}}" href="{{asset(''.$color->foto)}}" data-lightbox='roadtrip' class='img-thumbnail' data-title='{{$color->color}}'>
					<img class='img-responsive' src="{{asset(''.$color->foto)}}">
				</a>
				<div class='title'>Color: {{$color->color}}</div>
                <button class='btn btn-danger btn-sm borrar_foto_galeria' data-toggle="tooltip" data-placement="left" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                <button class='btn btn-info btn-sm editar_foto_galeria' data-toggle="tooltip" data-placement="right" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></button>
			</div>
		@endforeach
	@else 
		<div class='col-md-12'>
			<div class='alert alert-info'>
	        	<button class='close' data-dismiss='alert'></button>
	        	<a href='#' class='link'>Info:</a> No hay fotos para ésta categoría, por favor, asignelas y vuelva a consultar esta sección.
	        </div>
	    </div>
    @endif
</div>