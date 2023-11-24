@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
@include('admin._partials.messages')
    <section class="content-header">
    
      <h1>
        Contenidos para {{$section->name}}
      </h1>
      <a href=" {{ route('sections.index') }} " class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a secciones</a>     
      
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="pull-right">
                @if(config('app.debug'))
                  <a href="{{ route('contents.create' , ['s'=>$section->id]) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                @endif 
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="order">Index</th>
                  <th>Nombre</th>
                  <th style="width: 220px">Acciones</th>
                </tr>
                </thead>
                @php
                  $array_file = [4];
                @endphp
                <tbody>
                  @foreach($records as $key => $item)
                  <tr>
                    <td> {{ $key }}</td>
                    <td> {{ $item->name }}</td>
                    <td>
                      @if(config('app.debug'))
                      <a href="{{ route('contents.fields' , [$item->id , $section->id]) }}" class="btn btn-warning btn-flat" title="Campos"><i class="fa fa-bars"></i></a>
                      @endif
                      <a href="{{ route('contents.edit' , [$item->id , 's'=>$section->id]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
                      @if (in_array($item->id, $array_file) && (!empty($item->file_1) || !empty($item->file_2)))
                        <a  href="{{ route('contents.delete_pdf' ,$item->id) }}"  class="btn btn-danger btn-flat " title="Eliminar">Eliminar PDF</a> 
                      @endif
                    </td>
                  </tr>
                  @endforeach
                
              </tbody>
               
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection


@section('script')
<script>
</script>
@endsection