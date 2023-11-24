@extends('layouts.shop')
@section('content')

<div class="banner" style="margin-top: 8%;">
</div>
<forgot-password inline-template url_login="{{ route('login') }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
    <section class="account_form">
        <div class="account_form--cnt">
            <div class="acc_form_content">
                <h5>{{ __('titles.forgot_password') }}</h5>
                <form action="">
                    <div class="_input">
                        <b-form-input v-model="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null" placeholder="{{ __('forms.email') }}"></b-form-input>
                        <p class="error" v-if="!$v.email.required && email != null">{{ __('messages.required_email') }}</p>
                        <p class="error" v-if="!$v.email.email && email != null">{{ __('messages.email_invalid') }}</p>
                    </div>
                    <div class="_button-group">
                        <a href="{{ route('account.register') }}">{{ __('links.create_account') }}</a>
                        <button type="button" v-on:click="forgotPassword">{{ __('links.forgot') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</forgot-password>
@endsection
