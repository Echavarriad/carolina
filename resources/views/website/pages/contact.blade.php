@extends('layouts.master')
@section('content')
@include('_partials.banner')
<section class="contact">
    <div class="contact_cnt">
        <div class="contact_content">
            <div class="contact_data">
                <div class="_data-box">
                    <small>{{ __('titles.address') }}</small>
                    <div class="_info">
                        <figure>
                            <img src="{{ asset('img/icons/pin-map.svg') }}" alt="">
                        </figure>
                        <div class="_info-content">
                            {!! config('settings.address_section_contact') !!}
                        </div>
                    </div>
                </div>
                <div class="_data-box">
                    <small>{{ __('titles.email') }}</small>
                    <div class="_info">
                        <figure>
                            <img src="{{ asset('img/icons/email.svg') }}" alt="">
                        </figure>
                        <div class="_info-content">
                            {!! config('settings.email_section_contact') !!}
                        </div>
                    </div>
                </div>
                <div class="_data-box">
                    <small>{{ __('titles.phone') }}</small>
                    <div class="_info">
                        <figure>
                            <img src="{{ asset('img/icons/phone.svg') }}" alt="">
                        </figure>
                        <div class="_info-content">
                            {!! config('settings.phone_section_contact') !!}
                        </div>
                    </div>
                </div>
                <div class="_data-box">
                    <small>{{ __('titles.social_networks') }}</small>
                    <div class="_info">
                        <figure>
                            <img src="{{ asset('img/icons/redes.svg') }}" alt="">
                        </figure>
                        <div class="_info-content">
                            @include('_partials.social', ['show_title_social_network' => true])
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact_form">
                <form action="{{ url()->current() }}" id="formContact" method="POST" class="form-load">
                    @csrf
                    <div class="_input">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('forms.name') }}">
                    </div>
                    <div class="_input">
                        <input type="email" id="email" name="email" value="{{ old('email')}}" placeholder="{{ __('forms.email') }}">
                    </div>
                    <div class="_input">
                        <input type="text" id="phone" name="phone" value="{{ old('mobile') }}" placeholder="{{ __('forms.phone') }}">
                    </div>
                    <div class="_textarea">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="{{ __('forms.message') }}">{{ old('message') }}</textarea>
                    </div>
                    @include('_partials.check_politics', ['id_check' => 'contact_check'])
                    <div class="_submit">
                        <button type="button" id="btnSendContact">{{ __('links.send_message') }}</button>
                    </div>
                    <input type="hidden" name="_recaptcha" id="recaptcha">
                </form>
            </div>
        </div>
    </div>
</section>
<section class="contact_banner">
    <div class="contact_banner--cnt">
        <div class="contact_banner--content">
            <picture>
                <x-image image="{{ $section->contents[1]->image_1 }}" alt="{{ $section->contents[1]->alt_1 }}" tit="{{ $section->contents[1]->tit_1 }}" class=""></x-image>
            </picture>
            <div class="contact_banner--text">
                <div class="_txt">
                    {!! $section->contents[1]->text_1 !!}
                </div>
                <div class="_map">
                    @if(!empty(config('settings.url_google_maps')))
                        <a href="{{ config('settings.url_google_maps') }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/icons/google-maps.svg') }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@include('_partials.script_recaptcha', array('id_form' => 'formContact', 'message_send' =>  __('messages.send_email'), 'action' => 'form_contact'))
