@extends('layouts.shop')
@section('content')
    @include('_partials.banner')
    <register inline-template redirect_login="{{ $previous }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
        <section class="account_form">
            <div class="account_form--cnt">
                <div class="acc_form_content register">
                    <h5>{{ __('titles.create_account') }}</h5>
                    <form action="">
                        <div class="_input-group">
                            <div class="_input">
                                <b-form-input placeholder="{{ __('forms.document') }}" v-model="$v.name.$model"
                                    autofocus></b-form-input>
                                <p class="error">
                                    {{ __('messages.required_document') }}</p>
                            </div>
                            <div class="_input">
                                <b-form-input placeholder="{{ __('forms.name_account') }}" v-model="$v.name.$model"
                                    :state="$v.name.$dirty ? !$v.name.$invalid : null" autofocus></b-form-input>
                                <p class="error" v-if="!$v.name.required && name != null">
                                    {{ __('messages.required_name') }}</p>
                            </div>
                            <div class="_input">
                                <b-form-input placeholder="{{ __('forms.lastname') }}" v-model="$v.lastname.$model"
                                    :state="$v.lastname.$dirty ? !$v.lastname.$invalid : null" autofocus></b-form-input>
                                <p class="error" v-if="!$v.lastname.required && lastname != null">
                                    {{ __('messages.required_lastname') }}</p>
                            </div>
                        </div>
                        <div class="_input-group">
                            <div class="_input">
                                <b-form-input placeholder="{{ __('forms.email') }}" v-model.trim="$v.email.$model"
                                    :state="$v.email.$dirty ? !$v.email.$invalid : null"></b-form-input>
                                <p class="error" v-if="!$v.email.required && email != null">
                                    {{ __('messages.required_email') }}</p>
                                <p class="error" v-if="!$v.email.email && email != null">
                                    {{ __('messages.email_invalid') }}</p>
                            </div>
                            <div class="_input">
                                <b-form-input placeholder="{{ __('forms.phone') }}" v-model.trim="$v.mobile.$model"
                                    :state="$v.mobile.$dirty ? !$v.mobile.$invalid : null"></b-form-input>
                                <p class="error" v-if="!$v.mobile.required && mobile != null">
                                    {{ __('messages.required_mobile') }}</p>
                            </div>
                            <div class="_input">
                                <b-form-input type="password" placeholder="{{ __('forms.password') }}"
                                    v-model.trim="$v.password.$model"
                                    :state="$v.password.$dirty ? !$v.password.$invalid : null"
                                    autocomplete="new-password"></b-form-input>
                                <p class="error" v-if="!$v.password.required && password != null">
                                    {{ __('messages.required_password') }}</p>
                                <p class="error" v-if="!$v.password.minLength && password != null">
                                    {{ __('messages.min_password') }} @{{ $v.password.$params.minLength.min }}
                                    {{ __('messages.characters') }}</p>
                                <p class="error" v-if="!$v.password.isValidPassword && password != null">
                                    {{ __('messages.letter_number_password') }}</p>
                            </div>
                            <div class="_input">
                                <b-form-input type="password"placeholder="{{ __('forms.confirm_password') }}"
                                    v-model.trim="$v.confirm_password.$model"
                                    :state="$v.confirm_password.$dirty ? !$v.confirm_password.$invalid : null"></b-form-input>
                                <p class="error" v-if="!$v.confirm_password.sameAsPassword && confirm_password != null">
                                    {{ __('messages.not_same_password') }}</p>
                            </div>
                        </div>
                        @if (!empty(config('settings.doc_policy')))
                            <div class="_check">
                                <input type="checkbox" v-model="check">
                                <p>{{ __('forms.check_policy') }} <a
                                        href="{{ asset('uploads/' . config('settings.doc_policy')) }}"
                                        target="_blank">{{ __('links.click_here') }}</a></p>
                            </div>
                        @endif
                        <div class="_button">
                            <button type="button" v-on:click.prevent="createAccount">{{ __('links.register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </register>
@endsection
