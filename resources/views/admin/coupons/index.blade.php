@extends('admin.layouts.admin')
@section('content')
@include('admin._partials.messages')
<section class="content-header">
    <h1>{{ $plural }}</h1>      
</section>

<section class="content" id="app">      
    <div class="row">
        <div class="col-xs-12">          
            <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="pull-right">
                    <a href=" {{ route($name.'.create') }} " class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>                  
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Descuento</th>
                            <th>Fechas</th>
                            <th>Veces usado</th>
                            <th class="w-10">Activo</th>
                            <th class="w-15 actions">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $item)
                            <tr>
                                <td>{{ $item->name }}</td>  
                                <td><a href="#" onclick="copyToClipboard('Código', '#sp_{{$item->id}}')"><span id="sp_{{$item->id}}" title="Copiar">{{ $item->code }}</span> <i class="fa fa-copy"></i></a></td> 
                                <td>{{ $item->type_discount == 'percent' ? 'Porcentaje':'Monto' }}</td>
                                <td>{{ $item->type_discount == 'percent' ? $item->discount . '%': core()->currency($item->discount) }}</td>
                                <td>{{ $item->dateStart() . ' - ' . $item->dateEnd() }}</td> 
                                <td>{{ $item->quantity_redeem }}</td>  
                                <td class="btn-actions-index">
                                    <c-switch status="{{ $item->status }}" url="{{ route($name . '.status') }}" id="{{ $item->id }}"></c-switch>
                                </td>    
                                <td class="btn-actions-index">
                                    <a href="{{ route($name.'.edit' , [$item->id]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
                                    <form action="{{route($name.'.destroy' , [$item->id])}}" method="POST" style="display:inline;">@csrf 
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger btn-flat btn-delete" title="Eliminar" data-name ='{{ $item->name }}' data-table = 'este cupón'><i class="fa fa-trash"></i></button> </form>
                                </td>
                            </tr>
                        @endforeach                
                    </tbody> 
                </table>
            </div>
            </div>  
            {{ $records->appends(request()->input())->links('admin._partials.pagination') }}        
        </div>
    </div>
</section>
@endsection  
@include('admin._partials.copy') 