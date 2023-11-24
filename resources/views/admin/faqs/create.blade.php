@extends('admin.layouts.admin')

@section('content')
<section class="content-header"></section>
<section class="content">
    <div class="row">
        <form action="{{ route($name.'.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="col-md-10 col-sm-12">
            <div class="box box-info">	       
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo {{ $singular }}</h3>
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
                            <div class="tab-pane active fade in active" id="tab_1">
                                <label>Pregunta</label>
                                <input type="text" name="question" class="form-control" value="{{ old('question')}}">
                                <br>   

                                <label>Respuesta</label>
                                <textarea type="text" name="answer" class="tinymce">{{ old('answer')}}</textarea>
                                <br>

                                <input type="hidden" name="faq_category" value="{{ $section }}">
                                <input type="hidden" name="_back" value="{{ $back }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12"> 
            @include('admin._partials.save_cancel', array('url' => $back)) 
        </div>
        </form> 
    </div>
</section>

@endsection