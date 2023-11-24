@extends('admin.layouts.admin')

@section('content')

<section class="content">
  <section class="content-header" style="margin-bottom: 10px;">
      <a href="{{ route($name . '.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a> 
      
    </section>
   <div class="row">
   <div class="col-lg-7 col-md-12"> 
      <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">Detalle</h3>
          </div>
          <div class="box-body">                               
              <div class="row">
                <div class="col-sm-12">
                   <h4 class="details-order"><strong>Nombre:</strong> <span>{{ $user->name }}</span></h4>
                   <h4 class="details-order"><strong>Email:</strong> <span>{{ $user->email }}</span></h4>
                   <h4 class="details-order"><strong>{{  $user->type_document }}:</strong> <span>{{ $user->document }}</span></h4>
                   @if (!empty($user->phone))
                     <h4 class="details-order"><strong>Teléfono:</strong> <span>{{ $user->phone }}</span></h4>
                   @endif
                   @if (!empty($user->address))
                    <h4 class="details-order"><strong>Dirección:</strong> <span>{{ $user->address }}</span></h4>
                   @endif
                   @if (!empty($user->complement))
                    <h4 class="details-order"><strong>Complemento:</strong> <span>{{ $user->complement }}</span></h4>
                   @endif
                </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-12"> 
      <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">Últimas compras</h3>
          </div>
          <div class="box-body">                               
              <div class="row">
                <div class="col-sm-12">
                @foreach ($orders as $order)
                    <h4 class="values-order"><a href="{{ route('order.show', $order->id) }}"><strong>{{ $order->reference }}</strong></a> <span>{{ $order->total_format }}</span></h4>
                 @endforeach 
                 
                </div>
              </div>
          </div>

      </div>
    </div>
   </div>
</section>

@endsection