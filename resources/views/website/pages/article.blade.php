@extends('layouts.master')
@section('metas')
  <meta property="og:site_name" content="{{ config('settings.shop_name') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $article->title }}">
  <meta property="og:description" content="{{ $article->meta_description }}">
  <meta property="og:image" content="{{ asset('uploads/' . $article->image_intro) }}">
@stop
@section('content')
@include('_partials.banner')
<section class="blog">
  <div class="blog_cnt">
      <div class="blog_content">
          <div class="blog_info">
              <div class="blog_info--head">
                <h6>{{ __('titles.blog_and_novelties') }}</h6>
                <small>{{ $article->formatDate() }}</small>
              </div>
              <div class="_text">
                  <h1>{{ $article->title }}</h1>
                  <br>
                  {!! $article->text_single_top !!}
              </div>
              @if($article->gallery()->count() > 0)
              <div class="blog_images">
                  <div class="blog_images--view swiper">
                      <div class="swiper-wrapper">
                          @foreach($article->gallery as $item)
                            <div class="swiper-slide">
                                <picture>
                                    <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $article->alt }}" title="{{ $article->tit }}">
                                </picture>
                            </div>
                          @endforeach
                      </div>
                  </div>
                  <div class="blog_images--thumbs swiper">
                      <div class="swiper-wrapper">
                        @foreach($article->gallery as $item)
                          <div class="swiper-slide">
                              <picture>
                                  <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $article->alt }}" title="{{ $article->tit }}">
                              </picture>
                          </div>
                        @endforeach
                      </div>
                  </div>
              </div>
              @endif
              <div class="_text">
                {!! $article->text_single_bottom !!}
              </div>
              <div class="_links">
                  <a href="{{ route('articles') }}">
                    {{ __('links.return_to_blog') }}
                      <img src="{{ asset('img/icons/link.svg') }}" alt="">
                  </a>
                  <div class="_share">
                      <button>
                        {{ __('links.share') }}
                          <img src="{{ asset('img/icons/share.svg') }}" alt="">
                      </button>
                      <div class="_share-content">
                          <a class="cursor btn_share_facebook" data-url="{{ url()->current() }}" rel="noopener noreferrer">
                              <img src="{{ asset('img/icons/facebook.svg') }}" alt="">
                          </a>
                          <a class="cursor btn_share_whatsapp" data-url="{{ url()->current() }}" rel="noopener noreferrer">
                              <img src="{{ asset('img/icons/whatsapp.svg') }}" alt="">
                          </a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="related_blogs">
              @foreach($otherArticles as $article)
                @include('_partials.article', ['article' => $article])
              @endforeach
          </div>
      </div>
  </div>
</section>
@endsection