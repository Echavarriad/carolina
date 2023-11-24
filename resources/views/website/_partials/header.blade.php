<header>
    <div class="header_content">
        <div class="_brand">
            <button class="show_menu">
                <span></span>
            </button>
            <a href="{{ route('home') }}">
                <figure>
                    <img src="{{ asset('uploads/' . config('settings.shop_logo')) }}" alt="{{ config('settings.shop_name') }}">
                </figure>
            </a>
        </div>
        <div class="_navigation">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('menu.home') }}</a></li>
                    @foreach($menuCategories as $cat)
                        @if($cat->children->sum('count_products') > 0 )  
                            <li class="hasLinks">
                                <a href="{{ route('products.cat', $cat->slug) }}">
                                    {{ $cat->name }}
                                    <span></span>
                                </a>
                                @if($cat->children->count() > 0)
                                    <div class="category_links">
                                        <div class="category_links--wrapper">
                                            @foreach($cat->children as $subcat)
                                                @if($subcat->count_products > 0)
                                                    <a href="{{ route('products.subcat', [$cat->slug, $subcat->slug]) }}">{{ $subcat->name }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    <li><a href="{{ route('articles') }}">{{ __('menu.articles') }}</a></li>
                </ul>
            </nav>
        </div>
        <div class="_right-items">
            <div class="_account">
                @if(auth()->check())                
                    <a href="{{ route('account.home') }}">
                        <figure>
                            <img src="{{ asset('img/icons/account.svg') }}" alt="">
                        </figure>
                        <span>Mi cuenta</span>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <figure>
                            <img src="{{ asset('img/icons/account.svg') }}" alt="">
                        </figure>
                        <span>Sign in</span>
                    </a>
                @endif
            </div>
            <count-favorite inline-template ref="count_favorite" :qty="{{ Favorite::countFavorites() }}" v-cloak>
                <div class="_favorites">
                    <a href="{{ route('products.favorites')}}">
                        <figure>
                            <img src="{{ asset('img/icons/favorites.svg') }}">
                        </figure>
                        <span>@{{ count }}</span>
                    </a>
                </div>
            </count-favorite>
            <count-cart inline-template ref="count_cart" :qty="{{ Cart::count() }}" v-cloak>
            <div class="_cart">
                <a href="{{ route('shop.cart') }}">
                    <figure>
                        <img src="{{ asset('img/icons/cart.svg') }}" alt="">
                    </figure>
                    <span>@{{ count }}</span>
                </a>
            </div>
            </count-cart>
            <div class="_search">
                <button>
                    <img src="{{ asset('img/icons/search.svg') }}" alt="">
                </button>
            </div>
        </div>
    </div>
</header>
<aside class="whatsapp">
    <div class="whatsapp_cnt">
        <a class="cursor btn_action_wtspp" data-whatsapp="{{ config('settings.whatsapp') }}" data-text_whatsapp="{{ config('settings.text_whatsapp') }}"  rel="noopener noreferrer">
            <figure>
                <img src="{{ asset('img/icons/whatsapp.svg') }}" alt="">
            </figure>
        </a>
    </div>
</aside>
<search-products inline-template>
<section class="_search-box">
    <div class="_search-box_container" id="_search-box_container">
        <button class="close_search">&times;</button>
        <div class="_search-box_content">
            <div class="_search-form">
                <form action="" onSubmit="return false;">
                    <div class="_input">
                        <input type="text" v-model="term" id="" placeholder="{{ __('forms.search') }}" v-on:keyup="searchProduct">
                    </div>
                    <div class="_submit">
                        <button type="button">
                            <img src="{{ asset('img/icons/search.svg') }}" alt="">
                        </button>
                    </div>
                </form>
            </div>
            <div class="_search-results" v-if="products.length > 0">
                <ul>
                    <li class="_search-result_itm" v-for="item in products">
                        <a :href="item.route">
                            <div class="_search-result_itm--image">
                                <picture>
                                    <img :src="item.image" alt="">
                                </picture>
                            </div>
                            <div class="_search-result_itm--text">
                                <small>@{{ item.category }}</small>
                                <h6>@{{ item.name }}</h6>
                                <p>@{{ item.price }}</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
</search-products>
<main>