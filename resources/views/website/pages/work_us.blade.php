@extends('layouts.master')
@push('js')
  <script>
    $('body').addClass('__int');
  </script>
@endpush
@section('content')
@include('_partials.banner')
<section class="work_offers">
  <div class="work_offers_cnt">
      <div class="wrk_off--dsc">
          <div class="wrk_off--dsc_title">
              {!! $section->contents[1]->text_1 !!}
          </div>
          <div class="wrk_off--dsc_content">
            {!! $section->contents[1]->text_2 !!}
          </div>
      </div>
      <div class="work_offers_content">
          @foreach($offers as $item)
            <div class="wrk_off--item">
              <div class="wrk_off--item_title">
                  <h2>{{ $item->title }}</h2>
                  {!! $item->info !!}
              </div>
              <div class="wrk_off--item_description">
                  <div class="wrk_itm--desc">
                    {!! $item->work_expriencia !!}
                  </div>
                  <div class="wrk_itm--desc">
                    {!! $item->salary !!}
                  </div>
              </div>
              <div class="wrk_off--item_open">
                  <div class="wrk_off--op_itm">
                    {!! $item->description !!}
                  </div>
                  <div class="wrk_off--op_itm">
                    {!! $item->additional_information !!}
                  </div>
              </div>
              <div class="wrk_off--item_details">
                  <button class="open_details">
                      <img src="{{ asset('img/icons/bubble.svg') }}" alt="">
                      {{ __('links.see_offer') }}
                  </button>
                  <div class="app_offer">
                      <form action="">
                          <div class="_input">
                              <input type="file" name="" class="select-cv file-cv-{{$item->id}}" id="ap_off{{$item->id}}" data-id="{{ $item->id }}">
                              <label for="ap_off{{$item->id}}">
                                  <div class="_input-top">
                                      <h5>{{ __('titles.attach_cv') }}</h5>
                                      <hr>
                                      <p>{{ __('links.attach') }}</p>
                                  </div>
                                  <p id="mame-file-{{$item->id}}">{{ __('titles.file_not_attach') }}</p>
                              </label>
                          </div>
                          <button type="button" class="apply-to-offer" data-id="{{$item->id}}">
                              <img src="{{ asset('img/icons/bubble.svg') }}" alt="">
                              {{ __('links.apply_offer') }}
                          </button>
                      </form>
                  </div>
                  <a href="#" class="close_app">&times;</a>
              </div>
            </div>
          @endforeach
      </div>
  </div>
</section>
<input type="hidden" name="_recaptcha" id="recaptcha">
@endsection
@push('js')
<script>
  let action = 'Offer_job';
  grecaptcha.ready(function () {
     grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {
        action : action
     }).then(function(token){
           if(token){
                 document.getElementById('recaptcha').value = token;
           }
     });      
  });

    //Every 45 Seconds
  setInterval(function () {
     grecaptcha.ready(function () {
        grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {action: action}).then(function (token) {
           document.getElementById('recaptcha').value = token;
        });
     });
  }, 45000);
 </script>
@endpush
