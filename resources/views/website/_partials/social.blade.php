
@if(!empty(config('settings.facebook')))
     <a href="{{ config('settings.facebook') }}" target="_blank">
          @if(isset($show_title_social_network))
               Facebook /
          @else
               <img src="{{ asset('img/icons/facebook.svg') }}" alt="">
          @endif
     </a>
@endif 
@if(!empty(config('settings.twitter')))
     <a href="{{ config('settings.twitter') }}" target="_blank">
          @if(isset($show_title_social_network))
               Twitter /
          @else
               <img src="{{ asset('img/icons/twitter.svg') }}" alt="">
          @endif
     </a>
@endif
@if(!empty(config('settings.instagram')))
     <a  href="{{ config('settings.instagram') }}" target="_blank">
          @if(isset($show_title_social_network))
               Instagram /
          @else
               <img src="{{ asset('img/icons/instagram.svg') }}" alt="">
          @endif
     </a>
@endif

@if(!empty(config('settings.youtube')))
     <a href="{{ config('settings.youtube') }}" target="_blank">
          @if(isset($show_title_social_network))
               Youtube
          @else
               <img src="{{ asset('img/icons/youtube.svg') }}" alt="">
          @endif
     </a>
@endif

