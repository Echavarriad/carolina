@extends('layouts.shop')
@section('content')
<main>
    <checkout inline-template :data_cart="{{ json_encode($cart) }}" url_cart="{{ route('shop.cart') }}" :departments="{{ json_encode($departments) }}" :user="{{ json_encode($user) }}" auth="{{ auth()->user() }}" :data_address="{{ json_encode($address) }}" :documents="{{ json_encode($documents) }}" url_checkout="{{ route('shop.checkout') }}" url_payment="{{ route('shop.payment') }}"  :content="{{ json_encode(__('content_vue')) }}"  url_forgot_password="{{ route('account.forgot') }}" v-cloak>
    <section class="pay_pass">
        <div class="pay_pass_cnt">
            <div class="pay_data">                
                @include('shop.checkout._partials.head')
 
                @include('shop.checkout._partials.form_checkout')
                
            </div>
            @include('shop.checkout._partials.detail_payment')
        </div>
    </section>
    </checkout>
</main>
@endsection
