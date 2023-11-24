@if(!empty(config('settings.doc_policy')))
    <div class="_check">
        <input type="checkbox" id="{{ $id_check }}">
        <p>{{ __('forms.check_policy') }} <a href="{{ asset('uploads/' . config('settings.doc_policy'))}}" target="_blank">{{ __('links.click_here') }}</a></p>
    </div>
@endif