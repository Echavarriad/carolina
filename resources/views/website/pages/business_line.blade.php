@extends('layouts.master')
@push('js')
  <script>
    $('body').addClass('__int');
  </script>
@endpush
@section('metas')
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $business_line->name }}">
  <meta property="og:description" content="{{ $business_line->meta_description }}">
  <meta property="og:image" content="{{ asset('uploads/'.$business_line->banner) }}">
@stop
@section('content')
<section class="landing_banner">
  <div class="landing_banner_cnt">
      <div class="lnd_bnr--img">
        <img src="{{ asset('uploads/' . $business_line->banner) }}" class="desktop" alt="{{ $business_line->alt }}" title="{{ $business_line->tit }}">
        @php $mobile = !empty($business_line->banner_mobile) ? $business_line->banner_mobile : $business_line->banner;@endphp
        <img src="{{ asset('uploads/' . $mobile) }}" class="mobile" alt="{{ $business_line->alt }}" title="{{ $business_line->tit }}">
      </div>
      <div class="lnd_bnr--txt">
          {!! $business_line->text_banner !!}
      </div>
  </div>
</section>
@foreach ($business_line->content as $element)
    @include('pages.content_business_line.' . $element->content)
@endforeach

@endsection
