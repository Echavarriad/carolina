<section class="banner_int">
    <div class="banner_int--cnt">
        <div class="banner_int--content">
            <div class="banner_int--image">
                <picture>
                    <x-image image="{{ $category->image_banner }}" alt="{{ $category->alt }}" tit="{{ $category->tit }}" class=""></x-image>
                </picture>
            </div>
            <div class="banner_int--text">
                <h3>{{ $category->title_banner }}</h3>
            </div>
        </div>
    </div>
</section>