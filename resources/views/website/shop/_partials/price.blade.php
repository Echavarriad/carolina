@if($product->type_product == 'simple')
    {!! $product->priceProductSimple() !!}
@else
    <h5 class="{{ isset($class_price_view) ? $class_price_view : '' }}">{{ $product->price() }}</h5>
@endif