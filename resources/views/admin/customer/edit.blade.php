@extends('admin.layouts.admin')

@section('content')
<section class="content-header">  

</section>

<section class="content">
   <div class="row">
   <div class="col-md-10 col-sm-12"> 
	 <div class="box box-info">	       
            <div class="box-header with-border">
              <h3 class="box-title">Editar {{ $singular }}</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route($name.'.update',[$user->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="box-body">
             
             <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#tab_1" data-toggle="tab">Información</a>
                    </li> 
                </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab_1">
                  <label>Nombre </label>
                  <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                  @if ($errors->has('name'))
                     <label class="text-red">{{ $errors->first('name') }}</label>
                  @endif
                  <br>

                  <label>Correo electrónico </label>
                  <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                  @if ($errors->has('email'))
                     <label class="text-red">{{ $errors->first('email') }}</label>
                  @endif
                  <br>

                  <label>Tipo de documento</label>
                  <select name="type_document" class="form-control">
                    <option value="Cédula de ciudadanía" {{ $user->type_document ==  'Cédula de ciudadanía' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                    <option value="NIT" {{ $user->type_document ==  'NIT' ? 'selected' : '' }}>NIT</option>
                    <option value="Cédula de extranjería" {{ $user->type_document ==  'Cédula de extranjería' ? 'selected' : '' }}>Cédula de extranjería</option>
                    <option value="Pasaporte" {{ $user->type_document ==  'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                  </select>
                  <br>

                  <label>Documento</label>
                  <input type="text" name="document" class="form-control" value="{{ $user->document }}">
                  @if ($errors->has('document'))
                    <label class="text-red">{{ $errors->first('document') }}</label>
                  @endif
                  <br>
                 
                  <label>Celular</label>
                  <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}">
                  @if ($errors->has('mobile'))
                    <label class="text-red">{{ $errors->first('mobile') }}</label>
                  @endif
                  <br> 

                  <label>Teléfono</label>
                  <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                  @if ($errors->has('phone'))
                    <label class="text-red">{{ $errors->first('phone') }}</label>
                  @endif
                  <br>

                   <label>Actividad económica</label>
                  <input type="text" name="economic_activity" class="form-control" value="{{ $user->economic_activity }}">
                  @if ($errors->has('economic_activity'))
                    <label class="text-red">{{ $errors->first('economic_activity') }}</label>
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

       <div class="col-md-2 col-sm-12">        
          <!-- /.box-body -->
          @include('admin._partials.save_cancel', array('url' => route($name . '.index')))    
          <!-- /.box-footer -->
      </form>
      </div>
   </div>
</section>

@endsection
