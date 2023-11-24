<script>
    var token = "{{ csrf_token() }}";
    var baseRoot = "{{ url('/')}}";
    var title_envio_newsletter = "{{ __('messages.send_newsletter') }}";
    var title_registered_mail = "{{ __('messages.email_is_registered') }}";
    var title_error = "{{ __('messages.error_send_email') }}";
    var title_invalid_recaptcha = "{{ __('messages.invalid_recaptcha') }}";
    var email_invalid = "{{ __('messages.email_invalid') }}";
    var required_email = "{{ __('messages.required_email') }}";
    var selected_check = "{{ __('messages.selected_check') }}";
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  
<script src="{{ asset('js/app.js?v=' . config('settings.version_cache') .  '') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js" integrity="sha512-h5Vv+n+z0eRnlJoUlWMZ4PLQv4JfaCVtgU9TtRjNYuNltS5QCqi4D4eZn4UkzZZuG2p4VBz3YIlsB7A2NVrbww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset('js/main.js?v=' . config('settings.version_cache') .  '') }}"></script>
<script src="{{ asset('js/my_scripts.js?v=' . config('settings.version_cache')) }}"></script>
<script src="{{ asset('js/share.js?v=' . config('settings.version_cache')) }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@stack('js')