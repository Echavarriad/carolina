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
              <form action="{{ url()->current() }}" method="get">
                
                <div class="row">
                  <div class="col-lg-3">
                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ isset($field_form['name']) ? $field_form['name'] : '' }}"> 
                  </div>
                  <div class="col-lg-3">
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ isset($field_form['email']) ? $field_form['email'] : '' }}"> 
                  </div>
                  <div class="col-lg-3">
                    <input type="text" name="document" class="form-control" placeholder="Documento" value="{{ isset($field_form['document']) ? $field_form['document'] : '' }}"> 
                  </div>
                  <div class="col-lg-3">
                    <button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> 
                    <a href="{{ route($name . '.index') }}" class="btn btn-default"><i class="fa fa-times"></i> Limpiar</a> 
                  </div>
                </div> 
            </form>           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="w-15">Nombre</th>
                  <th class="w-20">Email</th>
                  <th class="w-10">Celular</th>
                  <th class="w-10">Tipo de documento</th>
                  <th class="w-10">Documento</th>
                  <th class="w-15">Último ingreso</th>
                </tr>
                </thead>

                <tbody>
               @foreach($records as $item)
                <tr>
                  <td>{{ $item->name . ' ' . $item->lastname }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->mobile }}</td>
                  <td>{{ $item->type_document }}</td>
                  <td>{{ $item->document }}</td>
                  <td class="drag-handle">{{ $item->format_date }}</td>
                </tr>
                @endforeach                
              </tbody>  
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         {{ $records->appends(request()->input())->links('admin._partials.pagination') }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection

@include('.admin._partials.datepicker')

