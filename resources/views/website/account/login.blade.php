@extends('layouts.shop')
@section('content')

@include('_partials.banner')
<login inline-template redirect_login="{{ $previous }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
    <section class="account_form">
        <div class="account_form--cnt">
            <div class="acc_form_content">
                <h5>{{ __('titles.log_in') }}</h5>
                <form action="">
                    <div class="_input">
                        <b-form-input v-model="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null" placeholder="{{ __('forms.email') }}"></b-form-input>
                        <p class="error" v-if="!$v.email.required && email != null">{{ __('messages.required_email') }}</p>
                        <p class="error" v-if="!$v.email.email && email != null">{{ __('messages.email_invalid') }}</p>
                    </div>
                    <div class="_input">
                        <b-form-input type="password" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null" v-on:keyup.enter="enterPassword" placeholder="{{ __('forms.password') }}"></b-form-input>
                        <p class="error" v-if="!$v.password.required && password != null">{{ __('messages.required_password') }}</p>
                    </div>
                    <div class="_recovery">
                        <a href="{{ route('account.forgot') }}">{{ __('links.forgot_password') }}</a>
                    </div>
                    <div class="_button-group">
                        <a href="{{ route('account.register') }}">{{ __('links.create_account') }}</a>
                        <button type="button" v-on:click.prevent="getLogin">{{ __('links.enter_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</login>
@endsection
