<div class="pay_prd">
    <div class="prd_to_pay">
        <ul>
            <li v-for="item in cart.items">
                <div class="pay_prd_data">
                    <div class="pp_img">
                        <span>@{{ item.quantity }}</span>
                        <img :src="item.image" alt="">
                    </div>
                    <div class="pp_txt">
                        <h6>@{{ item.name }}</h6>
                        <p>@{{ item.sku }}</p>
                    </div>
                </div>
                <div class="pay_prd_price">
                    <h6>@{{ item.total }}</h6>
                </div>
            </li>
        </ul>
    </div>
    <coupon inline-template :content="{{ json_encode(__('content_vue')) }}" v-on:updatecart="loadCart" v-cloak  v-if="cart.has_coupon == '0'">
        <div class="discount_to_pay">
            <form>
                <input type="text" name="" id="" placeholder="{{ __('forms.code_discount') }}"  v-model="coupon">
                <button type="submit" v-on:click.prevent="applyCoupon">{{ __('links.apply_descount') }}</button>
            </form>
        </div>
    </coupon>
    
    <div class="resume">
        <div class="rsm_itm">
            <h6>{{ __('titles.subtotal') }}</h6>
            <p>@{{ cart.sub_total }}</p>
        </div>
        <div class="rsm_itm" v-if="cart.has_coupon == '1'">
            <h6>{{ __('titles.discount') }}</h6>
            <p>
                <span class="coupon">{{ __('titles.coupon') }}: @{{ cart.coupon_code }} <span title="Eliminar cupón" v-on:click="removeCoupon">&times;</span></span>
                <span class="lessed">-@{{ cart.discount_text }}</span>
            </p>
        </div>
        <div class="rsm_itm">
            <h6>{{ __('titles.shipping') }}</h6>
            <p v-if="cart.shipping_status == 'ok' && cart.shipping_free == '0'">@{{ cart.shipping }}</p>
            <p v-if="cart.shipping_free == '1'">{{ __('titles.free_shipping') }}</p>
            <p  v-if="cart.shipping_status != 'ok' && cart.shipping_free == '0'">{{ __('titles.by_calculate') }}</p>
        </div>
    </div>
    <div class="total_to_pay">
        <h6>{{ __('titles.total') }}</h6>
        <p>@{{ cart.total }}</p>
    </div>
</div>