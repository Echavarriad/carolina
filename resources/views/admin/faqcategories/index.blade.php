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
                            <th>Categoría</th>  
                            <th class="w-10">Preguntas</th>
                            <th class="w-10">Destacado</th>
                            <th class="w-15 actions">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('faqs.index', ['foreign' => $item->id])}}">
                                        <i class="fa fa-list"></i>
                                        ({{ $item->faqs->count() }})
                                    </a>
                                </td>
                                <td class="btn-actions-index">
                                    <c-switch status="{{ $item->featured }}" url="{{ route($name . '.featured') }}" id="{{ $item->id }}"></c-switch>
                                </td>    
                                <td class="btn-actions-index">
                                    <a href="{{ route($name.'.edit' , [$item->id]) }}" class="btn btn-primary btn-flat" title="Editar"><i class="fa fa-edit"></i></a>
                                    <form action="{{route($name.'.destroy' , [$item->id])}}" method="POST" style="display:inline;">@csrf 
                                        @method('DELETE')
                                        <button  type="submit" class="btn btn-danger btn-flat btn-delete" title="Eliminar" data-name ='{{ $item->name }}' data-table = 'este registro'><i class="fa fa-trash"></i></button> 
                                    </form>
                                </td>
                            </tr>
                        @endforeach                
                    </tbody> 
                </table>
            </div>
            </div>        
        </div>
    </div>
</section>
@endsection  