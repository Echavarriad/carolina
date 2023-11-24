@if($user->orders->count() > 0)
<div class="acc_order">
    <h3>{{ __('titles.my_orders') }}</h3>
    <div class="acc_order--content">
        @foreach ($user->orders as $order)
            <div class="acc_order--content_itm">
                <div class="acc_order--itm_head">
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.nro_reference') }}</h4>
                        <h6>{{ $order->reference }}</h6> 
                    </div>
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.date') }}</h4>
                        <h6>{{ $order->format_order_date }}</h6>
                    </div>
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.status') }}</h4>
                        <h6 style="background-color: {{ $order->status->color }}; color: #fff;">{{ $order->status->name }}
                        </h6>
                    </div>
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.subtotal') }}</h4>
                        <h6>{{ $order->subtotal_format }}</h6>
                    </div>
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.shipping') }}</h4>
                        <h6>{{ $order->shipping_free ? 'Gratis' : $order->shipping_format }}</h6>
                    </div>
                    <div class="acc_hd--title">
                        <h4>{{ __('titles.total') }}</h4>
                        <h6>{{ $order->total_format }}</h6>
                    </div>
                    <button class="more_content"><img src="{{ asset('img/icons/add.svg') }}" alt=""></button>
                </div>
                <div class="acc_order--itm_content" style="display: none;">                            
                    <div class="acc_order_content--head">
                        <div class="acc_ord_ctt">
                            <h4>{{ __('titles.product') }}</h4>
                        </div>
                        <div class="acc_ord_ctt">
                            <h4>{{ __('titles.price') }}</h4>
                        </div>
                        <div class="acc_ord_ctt">
                            <h4>{{ __('titles.quantity') }}</h4>
                        </div>
                        <div class="acc_ord_ctt">
                            <h4>{{ __('titles.total_item') }}</h4>
                        </div>
                    </div>
                    @foreach ($order->items as $item)
                        <div class="acc_content--toggle">
                            <div class="acc_data--content">
                                <h6>{{ $item->name }}</h6>
                            </div>
                            <div class="acc_data--content">
                                <h6>{{ $item->price_format }}</h6>
                            </div>
                            <div class="acc_data--content">
                                <h6>{{ $item->quantity }}</h6>
                            </div>
                            <div class="acc_data--content">
                                <h6>{{ $item->price_total_format }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif