@extends('admin.layouts.admin')
@section('content')
<section class="content-header">
      <h1>
        Editar contenido
      </h1> 
</section>

<section class="content">
   <div class="row">
    <div class="col-lg-10 col-md-12">
	 <div class="box box-info">
	       @include('admin._partials.errors')
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->

            <form action="{{ route('contents.update',[$content->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">

             {{ csrf_field() }}
             {{ method_field('PUT') }}
             <div class="box-body">           
              <span class="info">Para cambiar lás imágenes haga clic sobre la imagen y seleccione la nueva.</span>
             <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">Contenido</a>
              </li> 
            </ul>
            <div class="tab-content section-content" id="app">

              <div class="tab-pane fade in active" id="tab_1">
                  @if(in_array('text_1', $contentFields['fields']))
                    @php
                     $label = $fields['text_1'];
                     if(isset($contentFields['labels']['text_1']))
                        $label = $contentFields['labels']['text_1'];
                    @endphp
                    <label>{{ $label }}</label>
                    <textarea name="text_1" class="tinymce"> {{$content->text_1}} </textarea>
                    <br>
                  @endif

                  @if(in_array('text_2', $contentFields['fields']))
                    @php
                      $label = $fields['text_2'];
                      if(isset($contentFields['labels']['text_2']))
                          $label = $contentFields['labels']['text_2'];
                    @endphp
                    <label>{{ $label }}</label>
                    <textarea name="text_2" class="tinymce"> {{$content->text_2}} </textarea>
                    <br>
                  @endif

                  @if(in_array('text_3', $contentFields['fields']))
                    @php
                    $label = $fields['text_3'];
                    if(isset($contentFields['labels']['text_3']))
                        $label = $contentFields['labels']['text_3'];
                    @endphp
                    <label>{{ $label }}</label>
                    <textarea name="text_3" class="tinymce"> {{$content->text_3}} </textarea>
                    <br>
                  @endif 
                  @if(in_array('text_4', $contentFields['fields']))
                    @php
                      $label = $fields['text_4'];
                      if(isset($contentFields['labels']['text_4']))
                        $label = $contentFields['labels']['text_4'];
                    @endphp
                    <label>{{ $label }}</label>
                    <textarea name="text_4" class="tinymce"> {{$content->text_4}} </textarea>
                    <br>
                  @endif
                  @if(in_array('image_1', $contentFields['fields']))
                    @php
                      $dimension = $fields['image_1'];
                      $width = $height = '';
                      if(isset($contentFields['dimensions']['image_1']))
                        $dimension = $contentFields['dimensions']['image_1'];
                      if(isset($contentFields['width']['image_1']))
                        $width = $contentFields['width']['image_1'];
                      if(isset($contentFields['height']['image_1']))
                        $height = $contentFields['height']['image_1'];
                    @endphp
                    <label>{{ $dimension . ' (' . $width . ' x ' . $height . ' px)' }}</label>
                    <upload-images :img="{{ json_encode($content->image_1) }}" id="{{ json_encode($content->id) }}" with="{{$width}}" height="{{$height}}" folder="content" model='Content' field='image_1' :del="true" :delrecord="false"></upload-images>
                    <br>
                    <div class="row">
                      <div class="col-sm-12 col-lg-6">
                        <label>Title de la imagen</label>
                        <input type="text" name="tit_1" class="form-control" value="{{ $content->tit_1 }}">
                      </div>
                      <div class="col-sm-12 col-lg-6">
                        <label>Alt de la imagen</label>
                        <input type="text" name="alt_1" class="form-control" value="{{ $content->alt_1 }}">
                      </div>
                    </div>
                    <br><br>
                  @endif
                  @if(in_array('image_2', $contentFields['fields']))
                    @php
                      $dimension = $fields['image_2'];
                      $width = $height = '';
                      if(isset($contentFields['dimensions']['image_2']))
                        $dimension = $contentFields['dimensions']['image_2'];
                      if(isset($contentFields['width']['image_2']))
                        $width = $contentFields['width']['image_2'];
                      if(isset($contentFields['height']['image_2']))
                        $height = $contentFields['height']['image_2'];
                    @endphp
                    <label>{{ $dimension . ' (' . $width . ' x ' . $height . ' px)' }}</label>
                    <upload-images :img="{{ json_encode($content->image_2) }}" id="{{ json_encode($content->id) }}" with="{{$width}}" height="{{$height}}" folder="content" model='Content' field='image_2' :del="true" :delrecord="false"></upload-images>
                    <br>
                    <div class="row">
                      <div class="col-sm-12 col-lg-6">
                        <label>Title de la imagen</label>
                        <input type="text" name="tit_2" class="form-control" value="{{ $content->tit_2 }}">
                      </div>
                      <div class="col-sm-12 col-lg-6">
                        <label>Alt de la imagen</label>
                        <input type="text" name="alt_2" class="form-control" value="{{ $content->alt_2 }}">
                      </div>
                    </div>
                    <br><br>
                  @endif
                  @if(in_array('image_3', $contentFields['fields']))
                      @php
                        $dimension = $fields['image_3'];
                        $width = $height = '';
                        if(isset($contentFields['dimensions']['image_3']))
                          $dimension = $contentFields['dimensions']['image_3'];
                        if(isset($contentFields['width']['image_3']))
                          $width = $contentFields['width']['image_3'];
                        if(isset($contentFields['height']['image_3']))
                          $height = $contentFields['height']['image_3'];
                      @endphp
                      <label>{{ $dimension . ' (' . $width . ' x ' . $height . ' px)' }}</label>
                      <upload-images :img="{{ json_encode($content->image_3) }}" id="{{ json_encode($content->id) }}" with="{{$width}}" height="{{$height}}" folder="content" model='Content' field='image_3' :del="true" :delrecord="false"></upload-images>
                      <br>
                      <div class="row">
                        <div class="col-sm-12 col-lg-6">
                          <label>Title de la imagen</label>
                          <input type="text" name="tit_3" class="form-control" value="{{ $content->tit_3 }}">
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          <label>Alt de la imagen</label>
                          <input type="text" name="alt_3" class="form-control" value="{{ $content->alt_3 }}">
                        </div>
                      </div>
                      <br><br>
                    @endif
                    @if(in_array('image_4', $contentFields['fields']))
                      @php
                        $dimension = $fields['image_4'];
                        $width = $height = '';
                        if(isset($contentFields['dimensions']['image_4']))
                          $dimension = $contentFields['dimensions']['image_4'];
                        if(isset($contentFields['width']['image_4']))
                          $width = $contentFields['width']['image_4'];
                        if(isset($contentFields['height']['image_4']))
                          $height = $contentFields['height']['image_4'];
                      @endphp
                      <label>{{ $dimension . ' (' . $width . ' x ' . $height . ' px)' }}</label>
                      <upload-images :img="{{ json_encode($content->image_4) }}" id="{{ json_encode($content->id) }}" with="{{$width}}" height="{{$height}}" folder="content" model='Content' field='image_4' :del="true" :delrecord="false"></upload-images>
                      <br>
                      <div class="row">
                        <div class="col-sm-12 col-lg-6">
                          <label>Title de la imagen</label>
                          <input type="text" name="tit_4" class="form-control" value="{{ $content->tit_4 }}">
                        </div>
                        <div class="col-sm-12 col-lg-6">
                          <label>Alt de la imagen</label>
                          <input type="text" name="alt_4" class="form-control" value="{{ $content->alt_4 }}">
                        </div>
                      </div>
                      <br><br>
                    @endif



                  @if(in_array('url_1', $contentFields['fields']))

                  <label>{{$fields['url_1']}}</label>
                  <input type="text" name="url_1" class="form-control" value="{{$content->url_1}}">
                  <br>

                  <label>Abrir en:</label>
                  <select name="target_1" class="form-control">
                    <option value="_self" {{ $content->target_1 == '_self' ? 'selected' : '' }}>La misma ventana</option>
                    <option value="_blank" {{ $content->target_1 == '_blank' ? 'selected' : '' }}>Una ventana nueva</option>
                  </select>
                  <br>

                  @endif



                  @if(in_array('url_2', $contentFields['fields']))

                  <label>{{$fields['url_2']}}</label>

                  <input type="text" name="url_2" class="form-control" value="{{$content->url_2}}">

                  <br>

                  @endif

                  @if(in_array('video', $contentFields['fields']))

                  <label>{{$fields['video']}}</label>

                  <input type="text" name="video" class="form-control" value="{{$content->video}}">

                  <br>

                  @endif 

                  @if(in_array('file_1', $contentFields['fields']))
                    @php
                     $label = $fields['file_1'];
                     if(isset($contentFields['labels']['file_1']))
                        $label = $contentFields['labels']['file_1'];
                    @endphp
                    <label>{{ $label }}</label>
                    <input type="file" name="file_1" class="form-control">
                    <delete-file :file="{{ json_encode($content->file_1) }}" id="{{ json_encode($content->id) }}" folder="content" model='Content' field='file_1'></delete-file>
                    <br>
                  @endif
                  <br>

                  @if(in_array('file_2', $contentFields['fields']))
                    @php
                     $label = $fields['file_2'];
                     if(isset($contentFields['labels']['file_2']))
                        $label = $contentFields['labels']['file_2'];
                    @endphp
                    <label>{{ $label }}</label>
                    <input type="file" name="file_2" class="form-control">
                    <delete-file :file="{{ json_encode($content->file_2) }}" id="{{ json_encode($content->id) }}" folder="content" model='Content' field='file_2'></delete-file>
                    <br>
                  @endif

              </div> 
            </div>
            <!-- /.tab-content -->            

            </div>

            <!-- /.tab-content -->

          </div>

        </div>  

      </div>

      <div class="col-lg-2 col-md-12">
          <div class="box-footer btn-actions">
            <a href="{{ route('contents.show' , [$id_section]) }}" class="btn btn-default"><i class="fa fa-times"></i> Cancelar</a>
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </form>
      </div>

    </div>

  </div>

</section>
@endsection 