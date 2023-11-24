@extends('admin.layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
@include('admin._partials.messages')
    <section class="content-header">
      <h1>{{ $plural }}</h1>  
      <br>   
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="w-40">Estado</th>
                  <th class="w-10">Color</th>
                  <th class="actions">Acciones</th>
                </tr>
                </thead>

                <tbody>
               @foreach($records as $item)
                <tr>
                   <td>{{ $item->name }}</td>
                  <td><div style="background: {{ $item->color }};width: 90px;height: 25px;"></div></td>
                  <td class="btn-actions-index"><a href="{{ route($name.'.edit' , [$item->id]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
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
   
