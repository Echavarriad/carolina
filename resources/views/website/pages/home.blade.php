@extends('layouts.master')
@section('content')
<section class="main_banner">
    <div class="main_banner--cnt">
        <div class="main_banner--content">
            <div class="main_banner--image">
                <picture>
                    <x-image image="{{ $section->contents[0]->image_1 }}" alt="{{ $section->contents[0]->alt_1 }}" tit="{{ $section->contents[0]->tit_1 }}" class=""></x-image>
                </picture>
                <div class="main_banner--products">
                    <div class="main_banner--products_cnt swiper">
                        <div class="swiper-wrapper">
                            @foreach($productsFeatured as $product)
                            <div class="swiper-slide">
                                @include('shop._partials.product')
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="main_banner--pagination"></div>
                </div>
            </div>
            <div class="main_banner--text">
                {!! $section->contents[0]->text_1 !!}
            </div>
        </div>
    </div>
</section>
<section class="products_block">
    <div class="products_block--cnt">
        <div class="products_block--title">
            {!! $section->contents[1]->text_1 !!}
            <div class="filters">
                <div class="_filters-wrapper">
                    <div class="_filters-title">
                        <h4>{{ __('titles.filter_by') }}</h4>
                    </div>
                    <div class="_filters-content">
                        <a href="{{ url()->current() . '?categoria=todas' }}" class="{{ !$categorySelected || $categorySelected == 'todas' ? 'active' : '' }}">{{ __('links.all_categories') }}</a>
                        @foreach($subCategories as $subcat)
                            <a href="{{ url()->current() . '?categoria='. $subcat->slug }}"
                                class="{{ $categorySelected == $subcat->slug ? 'active' : '' }}">{{ $subcat->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="_filter-next">
                    <a href="{{ route('products') }}">{{ __('links.see_more') }}</a>
                </div>
            </div>
        </div>
        <div class="products_block--content">
            @foreach($products as $product)
                @include('shop._partials.product')
            @endforeach
        </div>
    </div>
</section>
<section class="product_banner">
    <div class="product_banner--cnt">
        <div class="product_banner--content">
            <div class="_block-1">
                <picture>
                    <x-image image="{{ $section->contents[2]->image_1 }}" alt="{{ $section->contents[2]->alt_1 }}" tit="{{ $section->contents[2]->tit_1 }}" class=""></x-image>
                </picture>
            </div>
            <div class="_block-2">
                <a href="{{ $section->contents[2]->url_1 }}" target="{{ $section->contents[2]->target_1 }}">
                    <figure>
                        <img src="{{ asset('img/icons/link.svg') }}" alt="">
                    </figure>
                    <picture>
                        <x-image image="{{ $section->contents[2]->image_2 }}" alt="{{ $section->contents[2]->alt_2 }}" tit="{{ $section->contents[2]->tit_2 }}" class=""></x-image>
                    </picture>
                    <div class="_block-2_text">
                        {!! $section->contents[2]->text_1 !!}
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="featured_blog">
    <div class="featured_blog--cnt">
        <div class="featured_blog--content">
            @if(isset($articles[0]))
            <article class="st_blog">
                <div class="st_blog--image cursor" onclick="window.location.href=('{{ route('article', $articles[0]->slug) }}')">
                    <picture>
                        <x-image image="{{ $articles[0]->image_home }}" alt="{{ $articles[0]->alt }}" tit="{{ $articles[0]->tit }}" class=""></x-image>
                    </picture>
                </div>
                <div class="st_blog--text">
                    <div class="_head">
                        <h6>{{ __('titles.blog_and_novelties') }}</h6>
                        <small>{{ $articles[0]->formatDate() }}</small>
                    </div>
                    <div class="_title">
                        <h5 class="cursor" onclick="window.location.href=('{{ route('article', $articles[0]->slug) }}')">{{ $articles[0]->title }}</h5>
                    </div>
                    <div class="_content">
                        {!! substr($articles[0]->text_single_top, 0, 427) !!} ...
                    </div>
                    @include('_partials.links_articles', ['url' => route('article', $articles[0]->slug)])
                </div>
            </article>
            @endif
            @if(isset($articles[1]))
                @include('_partials.article', ['article' => $articles[1]])
            @endif
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
        let categorySelected= '{{ $categorySelected }}';
        $j= jQuery.noConflict();
        if(categorySelected != ''){
            var position = $j(".products_block--title").offset().top;
            $j('html, body').animate( {scrollTop : position}, 1000 );
        } 
    </script>
@endpush