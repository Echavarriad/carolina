@extends('layouts.shop')
@section('metas')
  <meta property="og:site_name" content="{{ config('settings.shop_name') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $product->title }}">
  <meta property="og:description" content="{{ $product->meta_description }}">
  <meta property="og:image" content="{{ asset('uploads/' . $product->image_intro) }}">
@stop
@section('content')
@include('shop._partials.banner')
<section class="product">
    <div class="product_cnt">        
        <add-to-cart inline-template :data_product="{{ json_encode($product) }}" :content="{{ json_encode(__('content_vue')) }}" v-cloak>
        <div class="product_content">            
                {{-- @include('shop._partials.gallery') --}}
                <gallery ref="gallery" :product="{{ json_encode($product) }}" :gallery="{{ json_encode($product->gallery) }}" :variations="{{ json_encode($product->variations) }}" v-cloak></gallery>
            {{-- @include('shop._partials.gallery') --}}
            <div class="product_data">
                <div class="product_data--title">
                    @if(!empty($product->sku))
                        <small>{{ __('titles.reference_view_product') }}{{ $product->sku }}</small>
                    @endif
                    <h2>{{ $product->name }}</h2>
                    <div class="_prices">
                        @include('shop._partials.price', ['class_price_view' => 'price'])                        
                        <h6 class="previous_price price_special"></h6>
                    </div>
                </div>
                    <div class="product_data--options">                    
                        @if($product->type_product == 'configurable')
                            @include('shop.product.variations')
                        @endif
                        <div class="_quantity">
                            <input type="number" v-model="quantity" id="quantity" v-on:blur="updateItem">
                            <div class="_controls">
                                <button class="more" v-on:click="addQty(1)"></button>
                                <button class="less" v-on:click="addQty(-1)"></button>
                            </div>
                        </div>
                        <div class="_add-cart">
                            <button v-on:click.prevent="addToCart">{{ __('links.add_to_cart') }}</button>
                        </div>
                        <div class="_fav-share">
                            <manager-favorite inline-template :product_id="{{ $product->id }}" :is_in_favorite= {{ json_encode(Favorite::isProductInFavorite($product->id))}} v-cloak>
                                <button class="addToFav" v-if="add_favorite" v-on:click.prevent="addProductToFavorite">
                                    <img src="{{ asset('img/icons/favorites.svg') }}" alt="">
                                </button> 
                                <button class="addToFav" v-else v-on:click.prevent="removeProductOfFavorite">
                                    <img src="{{ asset('img/icons/favorites-full.png') }}" alt="">
                                </button>
                            </manager-favorite>
                            <div class="view_image cursor">Ver imagen</div>
                            <div class="_share">                            
                                <button>
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
                @if(!empty($product->detail) || !empty($product->detail_additional))
                <div class="product_data--info">
                    <ul>
                        @if(!empty($product->detail))
                        <li class="product_data--info_itm">
                            <div class="_toggler _info-active">
                                <small>{{ __('titles.info_of_product') }}</small>
                                <span></span>
                            </div>
                            <div class="_content" style="display: block;">
                                {!! $product->detail !!}
                            </div>
                        </li>
                        @endif
                        @if(!empty($product->detail_additional))
                        <li class="product_data--info_itm">
                            <div class="_toggler {{ empty($product->detail) ? '_info-active' : '' }}">
                                <small>{{ __('titles.info_additional_of_product') }}</small>
                                <span></span>
                            </div>
                            <div class="_content" style="display: {{ empty($product->detail) ? 'block' : '' }}">
                                <p>
                                    {!! $product->detail_additional !!}
                                </p>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>                   
    </add-to-cart>
    </div>
</section>
@if(count($productRelateds))
    <section class="related_products">
        <div class="related_products_cnt">
            <div class="related_products--title">
                {!! $section->contents[1]->text_1 !!}
            </div>
            <div class="related_products_content">
                @foreach ($productRelateds as $product)
                    @include('shop._partials.product')
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
