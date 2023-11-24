@extends('admin.layouts.admin')

@section('content')
<section class="content-header"></section>
<section class="content" id="app">
   <div class="row">
      <form action="{{ route($name.'.update' , $record->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="col-md-10 col-sm-12">
         <div class="box box-info">        
            <div class="box-header with-border">
               <h3 class="box-title">Editar {{ $singular }}</h3>
            </div>
            
            <div class="box-body">
               @include('admin._partials.errors') 
               <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                     <li class="active">
                        <a href="#tab_1" data-toggle="tab">Contenido</a>
                     </li>                
                     <li>
                        <a href="#tab_2" data-toggle="tab">SEO</a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane active fade in active" id="tab_1">
                        <label>Categoría</label>
                        <input type="text" name="name" class="form-control" value="{{ $record->name }}">
                        <br>

                        <label>URL Amigable </label>
                        <input type="text" name="slug" class="form-control" value="{{ $record->slug }}">
                        <br>

                        <label>Título sobre el nombre</label>
                        <input type="text" name="title_over_name" class="form-control" value="{{ $record->title_over_name }}">
                        <br>

                        <label>Título del banner</label>
                        <input type="text" name="title_banner" class="form-control" value="{{ $record->title_banner }}">
                        <br>
                        @if($record->parent_id)
                           <label>Destacar (Estas subcategorías aparecerán en el filtro del home)</label>
                           <select name="featured" class="form-control">
                              <option value="1" {{ $record->featured ? 'selected' : '' }}>Destacar</option>
                              <option value="0" {{ !$record->featured ? 'selected' : '' }}>No destacar</option>
                           </select>
                           <br>
                        @endif

                        <label>Imagen del banner (1400 x 480 px)</label>
                        <upload-images :img="{{ json_encode($record->image_banner) }}" id="{{ json_encode($record->id) }}" with="1400" height="480" folder="category" model='Category' field='image_banner' :del="false" :delrecord="false"></upload-images>
                        <br>
                     </div>
                     <div class="tab-pane fade in" id="tab_2">
                        @include('admin._partials.meta_data', array('action' => 'edit', 'metas_img' => false))
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-2 col-sm-12">  
         @include('admin._partials.save_cancel', array('url' => route($name.'.index')))    
      </div>
      </form>
   </div>
</section>
@endsection