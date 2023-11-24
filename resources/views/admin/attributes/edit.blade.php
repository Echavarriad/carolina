@extends('admin.layouts.admin')
@section('content')

<section class="content-header"></section>

<section class="content" id="app">
    <div class="row">
        <form action="{{ route($name.'.update',[$record->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="col-md-10 col-sm-12"> 
            <div class="box box-info">	       
                <div class="box-header with-border">
                    <h3 class="box-title">Editar {{ $singular }}</h3>
                </div>
                <div class="box-body">
                    @include('admin._partials.errors')  
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab">Contenido</a>
                            </li> 
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab_1">
                                <label>Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ $record->name }}">
                                <br>

                                <label>Título en el select del sitio</label>
                                <input type="text" name="name_filter" class="form-control" value="{{ $record->name_filter }}">
                                <br>

                                <label for="">Tipo</label>
                                <select name="type" class="form-control">
                                    <option value="color" {{ $record->type == 'color' ? 'selected' : '' }}>Color</option>
                                    <option value="select" {{ $record->type == 'select' ? 'selected' : '' }}>Otro</option>
                                </select>
                                <br>
                                
                                <label>URL Amigable </label>
                                <input type="text" name="slug" class="form-control" value="{{ $record->slug }}">
                                <br>  
                            </div>
                            <input type="hidden" value="{{ $record->id }}" name="id" />                       
                        </div>                
                    </div>                
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            @include('admin._partials.save_cancel', array('url' => route($name . '.index')))
        </div>
        </form>
    </div>
</section>
@endsection
