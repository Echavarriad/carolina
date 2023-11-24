<div class="prd_itm">
    <div class="prd_itm--image">
        <a>
            <picture>
                <x-image image="{{ $product->image}}" alt="{{ $product->alt }}" tit="{{ $product->tit }}" class=""></x-image>
            </picture>
        </a>
        <div class="_options">
            <button class="toggler">
                <img src="{{ asset('img/icons/toggler.svg') }}" alt="">
            </button>
            <div class="_options-content">
                <manager-favorite inline-template :product_id="{{ $product->id }}" :is_in_favorite= {{ json_encode(Favorite::isProductInFavorite($product->id))}}>
                    <div>
                        <a href="#" v-if="add_favorite" v-on:click.prevent="addProductToFavorite">
                            <img src="{{ asset('img/icons/favorites.svg') }}" alt="">
                        </a>
                        <a href="#" v-else v-on:click.prevent="removeProductOfFavorite">
                            <img src="{{ asset('img/icons/favorites-full.png') }}" alt="">
                        </a>
                    </div>
                </manager-favorite>
                <a href="{{ $product->create_route() }}">
                    <img src="{{ asset('img/icons/link.svg') }}" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="prd_itm--text">
        <a href="{{ $product->create_route() }}">
            <small>
                {{ isset($product->subcategory()->name) 
                    ? $product->subcategory()->name
                    : '' }}
            </small>
            <h6>{{ $product->name }}</h6>
            <div class="prices">
                @include('shop._partials.price', ['class_price_view' => '', 'class_price_special' => ''])
            </div>
        </a>
    </div>
</div>