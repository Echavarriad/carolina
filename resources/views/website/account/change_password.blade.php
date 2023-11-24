@extends('layouts.shop')
@section('content')


<div class="banner" style="margin-top: 8%;">
</div>
    <section class="account_form">
        <div class="account_form--cnt">
            <div class="acc_form_content">
                <h5>{{ __('titles.change_password') }}</h5>
                <change-password url_login="{{ route('login') }}" :content="{{ json_encode(__('content_vue')) }}" :messages="{{ json_encode(__('messages')) }}" :forms="{{ json_encode(__('forms')) }}" :links="{{ json_encode(__('links')) }}"  show_form="yes"></change-password>
            </div>
        </div>
    </section>
@endsection
