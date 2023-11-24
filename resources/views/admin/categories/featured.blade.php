@extends('admin.layouts.admin')

@section('content')
<section class="content-header"></section>
<section class="content">
   <div class="row">
		<form action="{{ route($name.'.update' , $record->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="col-md-10 col-sm-12">
			<div class="box box-info">        
				<div class="box-header with-border">
				<h3 class="box-title">Destacar {{ $singular }}</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
			
				<div class="box-body">
					@if ($count_featured >= 4 && !$record->featured)
						<section class="content-header">
							<div class="alert alert-warning alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Solo se pueden destacar 4 categorías
							</div>
						</section>
					@endif             
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active">
							<a href="#tab_1" data-toggle="tab">Contenido</a>
							</li>                          
						</ul>
						<div class="tab-content">
							<div class="tab-pane active fade in active" id="tab_1">
								<label>Categoría</label>
								<input type="text" name="name" class="form-control" value="{{ $record->name }}">
								<br>
								<h3>Actualmente este registro es: <span>{{ $record->featured == 1 ? 'Destacado' : 'Ninguno' }}</span></h3> 
									<label>Seleccione una opción</label>
									<div class="btn-group">
										@if ($count_featured < 4)
											<input type="radio" data-element="0" name="_select_featured" value="0" {{ $record->featured == 1 ? 'checked' : '' }} class="radio-button">
											<label for="male">Destacado</label><br>
										@endif 
										<input type="radio" data-element="1" name="_select_featured" value="2" class="radio-button" {{ ($record->featured == 0) ? 'checked' : '' }}>
										<label for="female">Ninguno</label>
									</div>
									<br><br>

									<section id="featured" {{ $record->featured == 1 ? 'style = display:block' : 'style = display:none' }}>  
										<label>Imagen destacada del home (255 x 217 px)</label>
										<input type="file" name="image" class="form-control">
										<br>
										@if (!empty($record->image))
											<img src="{{ asset('uploads/'.$record->image) }}" width="150">
										@endif
											
										<br>
									</section>
							</div>
						</div>
					</div>
					<!-- /.tab-content -->
				</div> 
			</div>
		</div>
		<input id="_featured" name="_featured" type="hidden" value="1">
		<div class="col-md-2 col-sm-12">
				@include('admin._partials.save_cancel', array('url' => route($name.'.index')))
		</div>
		</form>
   	</div>
</section>

@endsection

@push('js')
	<script>
		$('.radio-button').click(function(event) {
	    element = $(this).data('element');
	    if(element == 0){
			$("#featured").css({'display' : 'block'});
	    }else{
			$("#featured").css({'display' : 'none'});
	    }
	});
	</script>
@endpush