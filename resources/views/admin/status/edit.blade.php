@extends('admin.layouts.admin')
@push('js')
  <script src="{{ url('mng/plugins/jscolor-2.4.5/jscolor.min.js') }}"></script>
@endpush
@section('content')
<section class="content-header">
  

</section>

<section class="content">
   <div class="row">
    <div class="col-lg-9 col-md-12">
	   <div class="box box-info">
	       @include('admin._partials.errors')
            <div class="box-header with-border">
              <h3 class="box-title">Editar {{ $singular }}</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route($name.'.update',[$record->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="box-body">
             
             <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#tab_1" data-toggle="tab">Contenido</a>
                    </li> 
                </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab_1">
                   <label>Estado</label>
                      <input type="text" name="name" class="form-control" value="{{ $record->name }}">
                      @if ($errors->has('name'))
                         <label class="text-red">{{ $errors->first('name') }}</label>
                      @endif
                      <br>

                      <label>Color</label>
                      <input type="text" name="color" class="form-control" value="{{ $record->color }}" data-jscolor="">
                      @if ($errors->has('color'))
                         <label class="text-red">{{ $errors->first('color') }}</label>
                      @endif
                      <br>

                  
              </div>
              <!-- /.tab-pane -->
             
            </div>
            <!-- /.tab-content -->
          </div>
             
              </div>
              
          </div>
      </div>

      <div class="col-lg-3 col-md-12">
        <!-- /.box-body -->
          @include('admin._partials.save_cancel', array('url' => route($name . '.index')))
          <!-- /.box-footer -->
        </form>
      </div>
   </div>
</section>

@endsection
