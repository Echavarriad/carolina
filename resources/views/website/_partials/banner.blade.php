<section class="banner_int">
    <div class="banner_int--cnt">
        <div class="banner_int--content">
            <div class="banner_int--image">
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