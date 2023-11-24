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
  <meta property="og:title" content="{{ $service->title }}">
  <meta property="og:description" content="{{ $service->meta_description }}">
  <meta property="og:image" content="{{ asset('uploads/'.$service->banner) }}">
@stop
@section('content')

<section class="banner_int">
  <div class="banner_int_cnt">
      <div class="bnr_int_img">
          <img src="{{ asset('uploads/' . $service->banner) }}" class="desktop" alt="{{ $service->alt}}" title="{{ $service->tit}}">
          @php $mobile = !empty($service->banner_mobile) ? $service->banner_mobile : $service->banner;@endphp
          <img src="{{ asset('uploads/' . $mobile) }}" class="mobile" alt="{{ $service->alt }}" title="{{ $service->tit }}">
      </div>
      <div class="bnr_int_txt">
        <h2>{{ __('titles.title_banner_services') }}</h2>
      </div>
  </div>
</section>

@include('pages.services.service_' . $service->id)

@endsection
