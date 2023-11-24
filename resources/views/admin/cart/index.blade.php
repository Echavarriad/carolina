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
            @include('admin._partials.form_range_dates')
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th class="w-20">Documento</th>
                  <th class="w-20">Correo</th>
                  <th class="w-10">Total</th>
                  <th class="w-15">Fecha</th>
                  <th class="actions">Acciones</th>
                </tr>
                </thead>

                <tbody>
               @foreach($records as $item)
                <tr>
                  <td>{{ $item->customer_name . ' ' . $item->customer_lastname }}</td>
                  <td>{{ $item->customer_document }}</td>
                  <td>{{ $item->customer_email }}</td>
                  <td>{{ $item->total }}</td>
                  <td class="drag-handle">{{ $item->format_date }}</td>
                  <td class="btn-actions-index"><a href="{{ route($name.'.show' , [$item->id]) }}" class="btn btn-primary btn-flat" title="Detalle"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
               
              
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         {{ $query->appends(request()->input())->links('admin._partials.pagination') }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection

@include('.admin._partials.datepicker')
   
