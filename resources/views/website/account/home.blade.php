@extends('layouts.shop')
@section('content')

@include('_partials.banner')
<section class="account">
    <div class="account_cnt">
        <div class="acc_name">
            <h5>{{ __('titles.welcome') }} <span>{{ $user->name . ' ' . $user->lastname }}</span></h5> 
            <a href="{{ route('logout') }}">{{ __('links.logout') }}</a>
        </div>
        <div class="acc_form--change">
            <my-account inline-template :data_user="{{ json_encode($user) }}" :content="{{ json_encode(__('content_vue')) }}" :documents="{{ json_encode($documents) }}" v-cloak>
                <form action="">
                    <h6>{{ __('titles.account_data') }}</h6>
                    <div class="_input">
                        <b-form-input placeholder="{{ __('forms.name_account') }}" v-model="$v.user.name.$model" :state="$v.user.name.$dirty ? !$v.user.name.$invalid : null" autofocus></b-form-input>
                        <p class="error" v-if="!$v.user.name.required && user.name != null">{{ __('messages.required_name') }}</p>
                    </div>
                    <div class="_input">
                        <b-form-input placeholder="{{ __('forms.lastname') }}" v-model="$v.user.lastname.$model" :state="$v.user.lastname.$dirty ? !$v.user.lastname.$invalid : null"></b-form-input>
                        <p class="error" v-if="!$v.user.lastname.required && user.lastname != null">{{ __('messages.required_lastname') }}</p>
                    </div>
                    <div class="_input">
                        <b-form-select  v-model="user.type_document" :options="documents" value-field="item" text-field="item">
                            <template #first>
                                <b-form-select-option :value="null" disabled>{{ __('forms.type_document') }}</b-form-select-option>
                            </template> 
                        </b-form-select>
                    </div>
                    <div class="_input">
                        <b-form-input placeholder="{{ __('forms.document') }}" v-model="user.document"></b-form-input>
                    </div>
                    <div class="_input">
                        <b-form-input placeholder="{{ __('forms.email') }}" v-model="$v.user.email.$model" :state="$v.user.email.$dirty ? !$v.user.email.$invalid : null"></b-form-input>
                        <p class="error" v-if="!$v.user.email.required && user.email != null">{{ __('messages.required_email') }}</p>
                        <p class="error" v-if="!$v.user.email.email && user.email != null">{{ __('messages.email_invalid') }}</p>
                    </div>
                    <div class="_input">
                        <b-form-input placeholder="{{ __('forms.mobile') }}" v-model="$v.user.mobile.$model" :state="$v.user.mobile.$dirty ? !$v.user.mobile.$invalid : null"></b-form-input>
                        <p class="error" v-if="!$v.user.mobile.required && user.mobile != null">{{ __('messages.required_mobile') }}</p>
                    </div>
                    <button type="button" v-on:click.prevent="updateAccount">{{ __('links.update') }}</button>
                    <a href="{{ route('account.address') }}" class="a-link">{{ __('links.my_addresses') }}</a>
                </form>
            </my-account>            
        </div>        
        <div class="acc_name account_form--cnt">            
            <change-password url_login="{{ route('login') }}" :content="{{ json_encode(__('content_vue')) }}" :messages="{{ json_encode(__('messages')) }}" :forms="{{ json_encode(__('forms')) }}" :links="{{ json_encode(__('links')) }}" show_form="not" v-cloak></change-password>
        </div>

        @include('account._partials.orders')

    </div>
</section>
@endsection