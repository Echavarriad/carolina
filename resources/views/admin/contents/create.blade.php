@extends('admin.layouts.admin')



@section('content')

<section class="content-header">    

</section>



<section class="content">

   <div class="row">

    <div class="col-md-8 col-md-offset-2">

	 <div class="box box-info">	       

            <div class="box-header with-border">

              <h3 class="box-title">Nuevo contenido para {{$section->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form action="{{ route('contents.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name')}}">
                <br>
                <input type="hidden" name="section_id" value="{{$section->id}}">  
                <input type="hidden" name="section_type" value="App\Models\Section">  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('contents.show' , $section->id) }}" class="btn btn-default"><i class="fa fa-times"></i> Cancelar</a>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar</button>
              </div>
              <!-- /.box-footer -->

            </form>

          </div>

      </div>

   </div>

</section>

@endsection