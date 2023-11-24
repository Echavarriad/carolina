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

<!-- Content Header (Page header) -->

@include('admin._partials.messages')

    <section class="content-header">    

      <h1>Suscriptores al boletín</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">       

          <div class="box">
            @if(count($records) > 0)
            <div class="pull-right options">
              <a href="{{ route($name . '.export') }}" class="cursor btn btn-danger"><i class="fa fa-cloud-arrow-down"></i> Descargar CSV</a>
            </div><br>
            @endif
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>

                <tr>
                  <th>Correo</th>
                  <th class="w-10">Eliminar</th>
                </tr>

                </thead>



                <tbody>

               @foreach($records as $item)

                <tr>
                 <td>{!! $item->email !!}</td>
                  <td>
                    <form action="{{route($name.'.destroy' , [$item->id])}}" method="POST" style="display:inline;">@csrf 

                    @method('DELETE')<buttton  type="submit" class="btn btn-danger btn-flat btn-delete" title="Eliminar" data-name = "{{ $item->email }}" data-table = 'este correo'><i class="fa fa-trash"></i></buttton></form>

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