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
                   <h4 class="details-order"><strong>Documento:</strong> <span>{{ $cart->customer_document }}</span></h4>
                   <h4 class="details-order"><strong>Nombre:</strong> <span>{{ $cart->customer_name . ' ' . $cart->customer_lastname }}</span></h4>
                   <h4 class="details-order"><strong>Correo:</strong> <span>{{ $cart->customer_email }}</span></h4>
                   <h4 class="details-order"><strong>Teléfono:</strong> <span>{{ $cart->customer_mobile }}</span></h4>
                </div>
              </div>
          </div>
      </div>      
    </div>
    <div class="col-lg-5 col-md-12"> 
      <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">Valores</h3>
          </div>
          <div class="box-body">                               
              <div class="row">
                <div class="col-sm-12"> 
                  <h4 class="values-order"><strong>Subtotal:</strong> <span>{{ $cart->sub_total }}</span></h4>
                  @if (!empty($cart->discount))
                    <h4 class="values-order"><strong>Descuento:</strong><span><label class="discount">(-)</label>{{ $cart->discount_text }}</span></h4>
                  @endif                    
                  @if ($cart->has_coupon)
                    <h4 class="values-order"><strong>Cupón:</strong><span><label class="discount">{{ $cart->coupon_code }}</label></span></h4>
                  @endif   
                  @if (!empty($cart->shipping_status == 'ok'))
                    <h4 class="values-order"><strong>Envío:</strong><span>{{ $cart->shipping_free ? 'Gratis' : $cart->shipping_rate }}</span></h4>
                  @endif   
                  <h4 class="values-order last"><strong>TOTAL:</strong><span>{{ $cart->total }}</span></h4>
                </div>
              </div>
          </div>

      </div>
      <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">Dirección</h3>
          </div>
          @if (!empty($cart->address))
            <div class="box-body address">                               
              <div class="row">
                <div class="col-sm-12">
                 <h4 class="details-order"><strong>Dirección:</strong> <span>{{ $cart->address->address }}</span></h4>
                  @if (!empty($cart->address->complement))
                    <h4 class="details-order"><strong>Complemento:</strong> <span>{{ $cart->address->complement }}</span></h4>
                  @endif
                  <h4 class="details-order"><strong>Ciudad:</strong> <span>{{ $cart->address->city . ' - ' . $cart->address->state }}</span></h4>
                </div>
              </div>
            </div>
          @endif 
      </div>
    </div>
    <div class="col-sm-12"> 
      <div class="box box-info">
          <div class="box-header with-border">
          <h3 class="box-title">Productos</h3>
          </div>
          <div class="box-body">                               
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="w-10">Sku</th>
                  <th class="w-10">Producto</th>
                  <th>Nombre</th>
                  <th class="w-7">Cantidad</th>
                  <th class="w-10">Precio</th>
                  <th class="w-105">Total</th>
                </tr>
                </thead>

                <tbody>
               @foreach($cart->items as $item)
                <tr>
                  <td>{{ $item->sku }}</td>
                  <td><img src="{{ $item->image }}" width="70"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>{{ $item->price }}</td>
                  <td>{{ $item->total }}</td>
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