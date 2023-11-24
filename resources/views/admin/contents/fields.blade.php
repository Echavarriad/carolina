@extends('admin.layouts.admin')



@section('content')

<section class="content-header">



    

</section>



<section class="content">

   <div class="row">

    <div class="col-md-10 col-md-offset-1">

	 <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Campos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('contents.save.fields') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                   <input type="text" class="form-control" name="_name_content" value="{{ $name_content }}">
                 </div>
                </div><br>
               <div class="row">
               	 <div class="col-md-12 fields-content">
               	 	@foreach($fields as $key => $item)
                    @php
                      $checked = '';
                      if(in_array($key, $currentFields['fields'])){
                        $checked = 'checked';
                      }
                    @endphp
                     <input class="form-check-input" name="fields[]" id="check<?php echo $key ?>" type="checkbox" value="{{$key}}" {{$checked}}>
                     <label class="form-check-label" for="check{{$key}}">{{$item}}</label>
                     @if(strpos($key , 'text') !== false)
                        @php
                         $value = '';
                         if(isset($currentFields['labels'][$key])){
                            if(!empty($currentFields['labels'][$key])){
                              $value = $currentFields['labels'][$key];
                            }
                         }
                        @endphp
                        <input  class="title"  type="text" name="labels[{{$key}}]" placeholder="Título" value="{{$value}}">

                     @endif
                     @if(strpos($key , 'image') !== false)
                        @php
                         $value = $width = $height = '';
                         if(isset($currentFields['dimensions'][$key])){
                            if(!empty($currentFields['dimensions'][$key])){
                              $value = $currentFields['dimensions'][$key];
                            }
                         }
                         if(isset($currentFields['width'][$key])){
                            if(!empty($currentFields['width'][$key])){
                              $width = $currentFields['width'][$key];
                            }
                         }
                         if(isset($currentFields['height'][$key])){
                            if(!empty($currentFields['height'][$key])){
                              $height = $currentFields['height'][$key];
                            }
                         }
                        @endphp
                        <input class="title" type="text" name="dimensions[{{$key}}]" placeholder="Título" value="{{$value}}">
                        <input class="size-img" type="number" name="width[{{$key}}]" placeholder="Ancho de la imagen" value="{{$width}}">
                        <span>x</span>
                        <input class="size-img" type="number" name="height[{{$key}}]" placeholder="Alto de la imagen" value="{{$height}}">
                        <span>px</span>

                     @endif

                     @if(strpos($key , 'file') !== false)
                        @php
                         $value = '';
                         if(isset($currentFields['labels'][$key])){
                            if(!empty($currentFields['labels'][$key])){
                              $value = $currentFields['labels'][$key];
                            }
                         }
                        @endphp
                        <input class="title" type="text" name="labels[{{$key}}]" placeholder="Título" value="{{$value}}">

                     @endif
                     <br>

                 @endforeach

               	 </div>

               </div>

               <input type="hidden" name="content" value="{{$id_content}}">

               <input type="hidden" name="section" value="{{$id_section}}">

             

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                <a href="{{ route('contents.show' , $id_section) }}" class="btn btn-default"><i class="fa fa-times"></i> Cancelar</a>

                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar</button>

              </div>

              <!-- /.box-footer -->

            </form>

          </div>

      </div>

   </div>

</section>



@endsection