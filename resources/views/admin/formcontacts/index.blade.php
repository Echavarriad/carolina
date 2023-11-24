@extends('admin.layouts.admin')
@section('content')
<style type="text/css" media="screen">
  .ui-sortable-helper {
    display: table;
}
#sortable tr:hover{
 cursor: pointer;
}
</style>
@include('admin._partials.messages')
    <section class="content-header">
      <h1>{{ $plural }}</h1>      
    </section>

    <!-- Main content -->
    <section class="content">      
      <div class="row">
        <div class="col-xs-12">          
          <div class="box">
            @if(count($records) > 0)
              <div class="pull-right options">
                <a href="{{ route($name . '.export') }}" class="cursor btn btn-danger"><i class="fa fa-cloud-arrow-down"></i> Descargar CSV</a>
              </div>
            @endif
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>                  
                  <th class="w-10">Nombre</th>
                  <th class="w-20">Correo</th>
                  <th class="w-10">Celular</th>
                  <th class="w-10">Ciudad</th>
                  <th class="w-10">Dirección</th>
                  <th class="w-10">Asunto</th>
                  <th class="w-10">Servicio</th>
                  <th>Mensaje</th>
                  <th class="w-7 actions">Acciones</th>
                </tr>
                </thead>

              <tbody>
              @foreach($records as $key => $item)
                    <tr> 
                        <td>{{ $item->name }}</td>  
                        <td>{{ $item->email }}</td>  
                        <td>{{ $item->mobile }}</td>  
                        <td>{{ $item->city }}</td>  
                        <td>{{ $item->address }}</td>  
                        <td>{{ $item->subject }}</td>  
                        <td>{{ $item->service }}</td>  
                        <td>{{ $item->message }}</td>  
                        <td class="btn-actions-index">
                            <form action="{{route($name.'.destroy' , [$item->id])}}" method="POST" style="display:inline;">@csrf 
                            @method('DELETE')
                            <buttton  type="submit" class="btn btn-danger btn-flat btn-delete" title="Eliminar" data-name ='{{ $item->name }}' data-table = 'este correo'><i class="fa fa-trash"></i></buttton> </form>
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