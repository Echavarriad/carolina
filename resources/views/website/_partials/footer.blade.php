</main>
<footer>
    <div class="footer_cnt">
        <div class="footer_top--box">
            <div class="_newsletter">
                <div class="_title">
                    <h6>Suscríbete a nuestra newsletter</h6>
                    <p>Tendrás, acceso a promociones exclusivas y ¡mucho más!</p>
                </div>
                <div class="_form">
                    <form action="">
                        <div class="_input">
                            <input type="email" name="" id="email_newsletter" placeholder="{{ __('forms.email') }}">
                            <input type="hidden" id="recaptcha_newsletter">
                        </div>
                        <div class="_submit">
                            <button type="button" id="sendNewsletter">
                                <img src="{{ asset('img/icons/link.svg') }}" alt="">
                            </button>
                        </div>
                        @include('_partials.check_politics', ['id_check' => 'newsletter_check'])
                    </form>
                </div>
            </div>
            <div class="_footer-links">
                <h6>{{ __('titles.help_center') }}</h6>
                <a href="{{ route('faqs') }}">{{ __('menu.shipping') }}</a>
                <a href="{{ route('faqs') }}">{{ __('menu.terms') }}</a>
                @if(!empty(config('settings.doc_policy')))
                    <a href="{{ asset('uploads/' . config('settings.doc_policy'))}}" target="_blank">{{ __('menu.policies') }}</a>
                @endif
                <!--a href="{{ route('faqs') }}">{{ __('menu.faqs') }}</a--->
            </div>
            <div class="_footer-links">
                <h6>{{ __('titles.company') }}</h6>
                <a href="{{ route('about_us') }}">{{ __('menu.about_us') }}</a>
                <a href="{{ route('contact') }}">{{ __('menu.contact') }}</a>
            </div>
            <div class="_footer-data">
                <h6>{{ __('titles.need_help') }}</h6>
                <a href="tel:+57 {{ config('settings.mobile_footer') }}">
                    <img src="{{ asset('img/icons/phone.svg') }}" alt="">
                    {{ config('settings.mobile_footer') }}
                </a>
                <a href="mailto:{{ config('settings.email_footer') }}">
                    <img src="{{ asset('img/icons/email.svg') }}" alt="">
                    {{ config('settings.email_footer') }}
                </a>
                <p>
                    <img src="{{ asset('img/icons/pin-map.svg') }}" alt="">
                    {{ config('settings.address_footer') }}
                </p>
                <div class="_social">
                    @include('_partials.social')
                </div>
            </div>
        </div>
        <div class="footer_bottom--box">
            <div class="_wrapper">
                <div class="_copy">
                    @if(!empty(config('settings.url_google_maps')))
                        <a href="{{ config('settings.url_google_maps') }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('img/icons/google-maps.svg') }}" alt="">
                        </a>
                    @endif
                    <p>{{ config('settings.shop_name') }} © {{ date('Y')}} - {{ __('titles.copyright') }}</p>
                </div>
                <div class="_madeBy">
                    <a href="//www.webcreativa.com.co/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('img/icons/logo-web.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('js')
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {
            action : 'Newsletter'
        }).then(function(token){
                if(token){
                    document.getElementById('recaptcha_newsletter').value = token;
                }
        });      
    });
 
    //Every 90 Seconds
    setInterval(function () {
        grecaptcha.ready(function () {
            grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {action: 'Newsletter'}).then(function (token) {
                document.getElementById('recaptcha_newsletter').value = token;
            });
        });
    }, 30000);
    </script>
 @endpush