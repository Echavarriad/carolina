@extends('admin.layouts.admin')

@section('content')
<section class="content-header"></section>
<section class="content" id="app">
    <div class="row">
        <div class="col-md-10 col-sm-12">
            <div class="box box-info">	       
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $attribute->name }}</h3>
                </div>            
                <div class="box-body">
                    @include('admin._partials.errors')  
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab">Opciones</a>
                            </li>                     
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in active" id="tab_1">
                                <attribute-options :attribute="{{ json_encode($attribute) }}"></attribute-options>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12"> 
            <div class="box-footer btn-actions">
                <a href="{{ route($name . '.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Regresar</a>
            </div> 
        </div>
    </div>
</section>

@endsection