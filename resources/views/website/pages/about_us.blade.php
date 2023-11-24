@extends('layouts.master')
@section('content')
@include('_partials.banner')
<section class="about_stBox">
    <div class="about_stBox--cnt">
        <div class="about_stBox--content">
            {!! $section->contents[1]->text_1 !!}
        </div>
    </div>
</section>
<section class="about_ndBox">
    <div class="about_ndBox--cnt">
        <div class="about_ndBox--content">
            <div class="about_image">
                <picture>
                    <x-image image="{{ $section->contents[2]->image_1 }}" alt="{{ $section->contents[2]->alt_1 }}" tit="{{ $section->contents[2]->tit_1 }}" class=""></x-image>
                </picture>
            </div>
            <div class="about_image">
                <picture>
                    <x-image image="{{ $section->contents[2]->image_2 }}" alt="{{ $section->contents[2]->alt_2 }}" tit="{{ $section->contents[2]->tit_2 }}" class=""></x-image>
                </picture>
            </div>
            <div class="about_image">
                <picture>
                    <x-image image="{{ $section->contents[2]->image_3 }}" alt="{{ $section->contents[2]->alt_3 }}" tit="{{ $section->contents[2]->tit_3 }}" class=""></x-image>
                </picture>
            </div>
            <div class="about_image">
                <picture>
                    <x-image image="{{ $section->contents[2]->image_4 }}" alt="{{ $section->contents[2]->alt_4 }}" tit="{{ $section->contents[2]->tit_4 }}" class=""></x-image>
                </picture>
            </div>
        </div>
    </div>
</section>
<section class="about_rdBox">
    <div class="about_rdBox--cnt">
        <div class="about_rdBox--content">
            <div class="about_rdBox--left">
                {!! $section->contents[3]->text_1 !!}
            </div>
            <div class="about_rdBox--right">
                <div class="_box">
                    <figure>
                        <img src="{{ asset('img/icons/about-icon.svg') }}" alt="">
                    </figure>
                    <div class="_text-box">
                        {!! $section->contents[4]->text_1 !!}
                    </div>
                </div>
                <div class="_box">
                    <figure>
                        <img src="{{ asset('img/icons/about-icon.svg') }}" alt="">
                    </figure>
                    <div class="_text-box">
                        {!! $section->contents[4]->text_2 !!}
                    </div>
                </div>
                <div class="_box">
                    <figure>
                        <img src="{{ asset('img/icons/about-icon.svg') }}" alt="">
                    </figure>
                    <div class="_text-box">
                        {!! $section->contents[4]->text_3 !!}
                    </div>
                </div>
                <div class="_box">
                    <figure>
                        <img src="{{ asset('img/icons/about-icon.svg') }}" alt="">
                    </figure>
                    <div class="_text-box">
                        {!! $section->contents[4]->text_4 !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about_rthBox">
    <div class="about_rthBox--cnt">
        <div class="about_rthBox--content">
            <div class="video_content">
                @if(!empty($section->contents[5]->video))
                    <a href="https://www.youtube.com/watch?v={{ $section->contents[5]->video }}" data-fancybox>
                        <picture>
                            <x-image image="{{ $section->contents[5]->image_1 }}" alt="{{ $section->contents[5]->alt_1 }}" tit="{{ $section->contents[5]->tit_1 }}" class=""></x-image>
                        </picture>
                        <figure>
                            <img src="{{ asset('img/icons/play.svg') }}" />
                        </figure>
                    </a>
                @else
                    <picture>
                        <x-image image="{{ $section->contents[5]->image_1 }}" alt="{{ $section->contents[5]->alt_1 }}" tit="{{ $section->contents[5]->tit_1 }}" class=""></x-image>
                    </picture>
                @endif
                <div class="video_content--text">
                    <figure>
                        <img src="{{ asset('img/icons/about-icon-2.svg') }}" alt="">
                    </figure>
                    {!! $section->contents[5]->text_1 !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
