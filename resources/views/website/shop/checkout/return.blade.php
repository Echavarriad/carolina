@extends('layouts.master')
@section('content')
<section class="banner_int">
    <div class="banner_int--cnt">
        <div class="banner_int--content">
            <div class="banner_int--image" style="aspect-ratio: inherit;">
                <picture>
                    <x-image image="{{ $section->contents[0]->image_1 }}" alt="{{ $section->contents[0]->alt_1 }}" tit="{{ $section->contents[0]->tit_1 }}" class=""></x-image>
                </picture>
            </div>
            <div class="banner_int--text">
                {!! $section->contents[0]->text_1 !!}
            </div>
        </div>
    </div>
</section>
<section class="thancks">
    <div class="title">
        {!! $section->contents[1]->text_1 !!}
    </div>
    <div class="text">
        {!! $section->contents[1]->text_2 !!}
    </div>
</section>
@endsection
