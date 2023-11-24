@extends('layouts.shop')
@section('content')
<div class="banner" style="margin-top: 8%;">
</div>
<cart inline-template :data_cart="{{ json_encode($cart) }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
<section class="cart_inner">
    <div v-if="has_items" class="cart_inner_cnt">
        <h1>{{ __('titles.my_cart') }}</h1>
        <div class="cart_content">
            <div class="cart_prd">
                <table>
                    <thead>
                        <th>{{ __('titles.product') }}</th>
                        <th>{{ __('titles.price') }}</th>
                        <th>{{ __('titles.quantity') }}</th>
                        <th>{{ __('titles.total') }}</th>
                    </thead>
                    <tbody>
                        <tr v-for="item in cart.items">
                            <td>
                                <div class="cart_prd_name">
                                    <span v-on:click="deleteItem(item)" title="Eliminar del carrito">&times;</span>
                                    <div class="cnt_img">
                                        <img :src="item.image" alt="">
                                    </div>
                                    <div class="cnt_txt">
                                        <h6>@{{ item.name }}</h6>
                                        <p>@{{ item.sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>@{{ item.price }}</td>
                            <td>
                                <div class="cnt_count">
                                    <input type="number" name="" id="" v-model="item.quantity" v-on:blur="updateItem(item)">
                                    <div class="counter">
                                        <a href="#" v-on:click.prevent="addQuantity(item, 1)">+</a>
                                        <a href="#" v-on:click.prevent="addQuantity(item, -1)">-</a>
                                    </div>
                                </div>
                            </td>
                            <td>@{{ item.total }}</td>
                        </tr>
                    </tbody>
                </table>
                @if(config('settings.limit_shipping_free') > 0)
                    <div class="free_shipping">
                        <div class="process">
                            <span id="current" :style="{width : cart.percent_shipping_free + '%'}">@{{ cart.percent_shipping_free }}%</span>
                        </div>
                        <p v-if="cart.percent_shipping_free < 100">Compra {{ core()->currency(config('settings.limit_shipping_free')) }} para obtener envío gratis</p>
                        <p v-else>¡¡Felicitaciones!!, tienes envío gratis</p>
                    </div>
                @endif
            </div>
            <div class="cart_total">
                <h5>{{ __('titles.purchase_detail') }}</h5>
                <div class="total">
                    <table>
                        <tbody>
                            <tr>
                                <td>{{ __('titles.subtotal') }}</td>
                                <td>@{{ cart.sub_total }}</td>
                            </tr>
                            <tr v-if="cart.has_coupon == '1'">
                                <td>{{ __('titles.discount') }}</td>
                                <td>
                                    <span class="coupon">{{ __('titles.coupon') }}: @{{ cart.coupon_code }} <span title="Eliminar cupón" v-on:click="removeCoupon">&times;</span></span>
                                    <span class="lessed">-@{{ cart.discount_text }}</span>
                                </td>
                            </tr>
                            <tr v-if="cart.shipping_free == '0'">
                                <td>{{ __('titles.shipping') }}</td>
                                <td v-if="cart.shipping_status == 'ok'">@{{ cart.shipping }}</td>
                                <td  v-else>{{ __('titles.by_calculate') }}</td>
                            </tr>
                            <tr v-else>
                                <td>{{ __('titles.shipping') }}</td>
                                <td>{{ __('titles.free_shipping') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('titles.total') }}</td>
                                <td>@{{ cart.total }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('shop.checkout') }}">{{ __('links.pay') }}</a>
                </div>
            </div>
        </div>
        <coupon inline-template :content="{{ json_encode(__('content_vue')) }}" v-on:updatecart="loadCart" v-cloak>
            <div class="discount">
                <form>
                    <input type="text" name="" id="" placeholder="{{ __('forms.code_discount') }}"  v-model="coupon">
                    <button type="submit" v-on:click.prevent="applyCoupon">{{ __('links.apply_descount') }}</button>
                </form>
                <img src="{{ asset('img/pay.png') }}" alt="">
            </div>
        </coupon>
    </div>
    <div v-else class="cart_inner_cnt">
        <h3>{{ __('titles.not_products_cart') }}</h3>
        <a href="{{ route('products') }}" class="btn-primary-custom">{{ __('links.see_products') }}</a>
    </div>
</section>
</cart>
@endsection
