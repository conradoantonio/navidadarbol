<div id="galeria" class="text-center" style="margin-top: 20px;">
	@if (count($colores)) 
		@foreach ($colores as $key => $foto) 
			<div id="{{$key}}" class='col-sm-3 text-center foto'>
				<a id="{{$key}}" href="{{asset(''.$foto->foto)}}" data-lightbox='roadtrip' class='img-thumbnail' data-title='{{$foto->color}}'>
					<img class='img-responsive' src="{{asset(''.$foto->foto)}}">
				</a>
				<div class='title'>{{$foto->color}}</div>
                <button class='btn btn-danger btn-sm borrar_foto_galeria'>Borrar</button>
			</div>
		@endforeach
	@else 
		<div class='col-md-12'>
			<div class='alert alert-info'>
	        	<button class='close' data-dismiss='alert'></button>
	        	<a href='#' class='link'>Info:</a> No hay imágenes que mostrar, suba contenido para ver la galería de imágenes de sus categorías.
	        </div>
	    </div>
    @endif
</div>