@extends('layouts.shop')
@section('content')
<main>
    <payment inline-template :data_cart="{{ json_encode($cart) }}" auth="{{ auth()->user() }}"  :content="{{ json_encode(__('content_vue')) }}" url_checkout="{{ route('shop.checkout') }}" :gateways="{{ json_encode($gateways) }}" v-cloak>
    <section class="pay_pass">
        <div class="pay_pass_cnt">
            <div class="pay_data">
                @include('shop.checkout._partials.head')
                <div class="table_info">
                    <table>
                        <tbody>
                            <tr>
                                <td>{{ __('titles.contact') }}</td>
                                <td>@{{ cart.customer_email }}</td>
                                <td><a href="{{ route('shop.checkout') }}">{{ __('links.change') }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ __('titles.send_to') }}</td>
                                <td>@{{ cart.address.address }}, @{{ cart.address.city }} - @{{ cart.address.state }}</td>
                                <td><a href="{{ route('shop.checkout') }}">{{ __('links.change') }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ __('titles.shipping') }}</td>
                                <td v-if="cart.shipping_free == '0'">@{{ cart.shipping }}</td>
                                <td v-else>{{ __('titles.free_shipping') }}</td>
                                <td></td>
                            </tr>
                            <tr v-if="cart.shipping_free == '0'">
                                <td>{{ __('titles.carrier') }}</td>
                                <td >@{{ cart.shipping_description }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h6>Pagos</h6>
                <p>Todas las transacciones son seguras y están encriptadas.</p>
                <div class="address_fact">
                    <div class="bl_fnlzcom_f carrier-payment">
                        <input type="radio" checked="checked"> 
                        <div class="content"><h5>
                            <img src="{{ asset('uploads/' . $gateways[0]->logo) }}" alt=""></h5> 
                            <div class="content-payment">
                                <img src="https://www.papyser.com/tienda/img/icono_envios_pantalla.png" alt=""> 
                                <p>Será redireccionado a {{$gateways[0]->name }} para realizar el pago. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pay_back">
                    <a href="{{ route('shop.checkout') }}">
                        < {{ __('links.back_info') }}</a> 
                        <button v-on:click="finalizePurchase">
                            {{ __('links.finalize_purchase') }}</button>
                </div>
            </div>

            @include('shop.checkout._partials.detail_payment')
        </div>        
        <form ref="form_checkout" :action="url_wompi" method="GET">
            <input type="hidden" v-for="(item, index) in fields_payment" :name="index" :value="item">
        </form>
    </section>
    </payment>
</main>
@endsection
