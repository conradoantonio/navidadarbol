<div id="galeria" class="text-center" style="margin-top: 20px;">
	<div class="row">
		@if (count($colores)) 
			@foreach ($colores as $color) 
				<div id="{{$color->categoria_color_id}}" cat_id="{{$color->categoria_id}}" class='col-sm-3 text-center color'>
					<a id="{{$color->categoria_color_id}}" href="{{asset(''.$color->foto)}}" data-lightbox='roadtrip' class='img-thumbnail' data-title='{{$color->color}}'>
						<img class='img-responsive' style="width: 90px; height: 90px;" src="{{asset(''.$color->foto)}}">
					</a>
					<div class='title'>{{$color->color}}</div>
	                <button class='btn btn-danger btn-sm borrar_color_galeria'>Borrar</button>
				</div>
			@endforeach
		@else 
			<div class='col-md-12'>
				<div class='alert alert-info'>
		        	<button class='close' data-dismiss='alert'></button>
		        	<a href='#' class='link'>Info:</a> No hay colores asignados a esta categoría, por favor, asigne uno o más colores para poderlos mostrar en esta sección.
		        </div>
		    </div>
	    @endif
	</div>
</div>