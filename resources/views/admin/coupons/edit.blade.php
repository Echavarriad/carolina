@extends('admin.layouts.admin')
@push('css')
   <link type="text/css" rel="stylesheet" href="{{ asset('mng/plugins/typeahead/typeahead.min.css') }}" />  
@endpush
@section('content')

<section class="content-header"></section>

<section class="content">
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
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12">
                                        <label>Nombre de cupón</label>
                                        <input type="text" name="name" class="form-control" value="{{ $record->name }}"><br>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Código del cupón</label>
                                        <input type="text" name="code" class="form-control" value="{{ $record->code }}"  id="value-code">
                                        <span>
                                        <button class="btn btn-primary btn-generate-code">Generar</button>
                                        </span><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Fecha inicial</label>
                                        <input type="text" name="start" class="form-control datepicker" value="{{ $record->start }}" autocomplete="off"><br>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Fecha final</label>
                                        <input type="text" name="end" class="form-control datepicker" value="{{ $record->end }}" autocomplete="off">
                                        <br>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label>Tipo</label>
                                        <select name="limited" class="form-control" id="select-limited">
                                            <option value="0" {{ $record->limited == 0 ? 'selected' : '' }}>Ilimitado</option>
                                            <option value="1" {{ $record->limited == 1 ? 'selected' : '' }}>Cantidad</option>
                                        </select><br>
                                    </div>
                                </div> 
                                <div class="" id="quantity" style="display: none;">
                                    <label>Cantidad</label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $record->quantity }}" autocomplete="off"><br>
                                </div>
                                
                                <div>
                                    <label>Usuario en específico</label>
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <div class="typeahead__query">
                                                <input type="text" name="_email_customer" class="form-control js-typeahead-user-coupon" value="{{ !empty($record->user) ? $record->user->email : '' }}"autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div> 
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Cantidad mínima de productos</label>
                                        <input type="number" name="min_quantity" class="form-control" value="{{ $record->min_quantity  == '' ? 1 : $record->min_quantity }}"><br>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                         <label>Valor mínimo de la compra</label>
                                        <input type="number" name="min_amount" class="form-control" value="{{ $record->min_amount  == '' ? 0 : $record->min_amount }}"><br>
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Tipo de descuento</label>
                                        <select name="type_discount" class="form-control" id="select-type">
                                            <option value="percent" {{ $record->type_discount == 'precent' ? 'selected' : '' }}>Porcentaje (%)</option>
                                            <option value="amount" {{ $record->type_discount == 'amount' ? 'selected' : '' }}>Monto ($)</option>
                                        </select><br>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Valor del descuento</label>                             
                                        <input type="number" name="discount" class="form-control" value="{{ $record->discount  == '' ? 0 : $record->discount }}" id="discount" step="0.01">
                                        <span class="icons" id="icon-amount"><i class="fas fa-dollar-sign"></i></span>
                                        <span class="icons" id="icon-percent"><i class="fas fa-percent"></i></span>
                                        <br>
                                    </div> 
                                </div>
                            </div>
                            <input type="hidden" value="{{ $record->id }}" name="id"/>                      
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

@push('js')
    <script src="{{ asset('mng/plugins/typeahead/typeahead.min.js') }}"></script>
    <script src="{{ asset('mng/plugins/typeahead/search_customer_coupon.js') }}"></script>
    <script>
        let type_discount = '{{ $record->type_discount }}';
        let limited = '{{ $record->limited }}';
        if(type_discount == 'amount'){
            $('#icon-percent').fadeOut();
            $('#icon-amount').fadeIn();
        }

        if(limited == 1){
            $('#quantity').fadeIn();
        }

        $('#select-limited').change(function(event) {
            let value = $(this).val();
            if(value == 0){
                $('#quantity').fadeOut();
            }else{
                $('#quantity').fadeIn();
            }
        });

        $('#select-type').change(function(event) {
            let value = $(this).val();
            $('#discount').focus();
            if(value == 'amount'){
                $('#icon-percent').fadeOut();
                $('#icon-amount').fadeIn();
            }else{
                $('#icon-amount').fadeOut();
                $('#icon-percent').fadeIn();
            }
        });
        
        $('.btn-generate-code').click(function(event) {
            event.preventDefault();
            let val = new String (Math.random().toString(36).substring(2,8));
            val.toUpperCase();
            $('#value-code').val(val.toUpperCase())
        });
    </script>
@endpush

