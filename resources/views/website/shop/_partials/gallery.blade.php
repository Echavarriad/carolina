<div class="product_images--thumbs swiper">
    <div class="swiper-wrapper">
        @php $index = 1;@endphp
        <div class="swiper-slide">
            <picture>
                <img src="{{ asset('uploads/' . $product->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
            </picture>
        </div>
        @foreach($product->gallery as $item)
        @php  $index++;  @endphp
            <div class="swiper-slide">
                <picture>
                    <img src="{{ asset('uploads/' . $item->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
                </picture>
            </div>
        @endforeach
        @foreach($product->variations as $item)
            @if(!empty($item->image))
                @php  $index++;  @endphp
                <div class="swiper-slide">
                    <picture>
                        <img src="{{ asset('uploads/' . $item->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
                    </picture>
                </div>
            @endif
        @endforeach
    </div>
</div>
{{-- <div class="product_images--view swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <picture>
                <img src="{{ asset('uploads/' . $product->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
            </picture>
        </div>
        @foreach($product->gallery as $item)
            <div class="swiper-slide">
                <picture>
                    <img src="{{ asset('uploads/' . $item->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
                </picture>
            </div>
        @endforeach
        @foreach($product->variations as $item)
            @if(!empty($item->image))
            <div class="swiper-slide">
                <picture>
                    <img src="{{ asset('uploads/' . $item->image)}}" alt="{{ $product->alt }}" title="{{ $product->tit }}">
                </picture>
            </div>
            @endif
        @endforeach
    </div>
</div> --}}