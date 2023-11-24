@extends('admin.layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
@include('admin._partials.messages')
    <section class="content-header">
      <h1>
        Traducciones
      </h1>
      <br>
      <br>
        <a href=" {{ route('translation.index') }} " class="btn btn-primary"><i class="fa fa-arrow-left"></i> Volver a traducciones</a>
      @if(config('app.debug'))
        <div class="pull-right">
          <a href="{{ route('translationelement.create' , ['s' => $element]) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
        </div>
      @endif
     
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header">
              <div class="col-md-4" style="float: right;">
                <input type="text" id="search" onkeyup="searchTable()" placeholder="Buscar.." class="form-control" autocomplete="off">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if ( $element == 'routes')
              <p style="font-size: 18px;font-weight: 600;color: red;">Los valores que se encuentran encerrados en <strong>{}</strong> NO se deben modificar</p>
            @endif
            
              <table id="tableData" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="w-10">Clave</th>
                  <th>Texto</th>
                  <th class="actions">Acciones</th>
                </tr>
                </thead>

                <tbody id="sortable">
                @foreach($langs['es'] as $key => $value)
                <tr>
                  <td>{{$key}}</td>
                  <td>{{$value}}</td>
                  <td>
                    <a href="{{ route('translationelement.edit' , [$key, 's' => $element]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
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


@push('js')
<script>
  
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tableData tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endpush