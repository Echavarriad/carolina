<div class="logo_cart">
    <a href="{{ route('home') }}">
        <img src="{{ asset('uploads/' . config('settings.shop_logo')) }}" alt="{{ config('settings.shop_name') }}">
    </a>
</div>
<div class="cart_bread">
    <a href="{{ route('home') }}">Inicio</a>
    <span><img src="{{ asset('img/icons/right-arrow.svg') }}" alt=""></span>
    @foreach($breadcrumb as $key => $item)
        @if ($item)
            @if($item['url'])
                <a href="{{ $item['url'] }}">{{ $item['title']}}</a>
                <span><img src="{{ asset('img/icons/right-arrow.svg') }}" alt=""></span>
            @else
                <p>{{ $item['title']}}</p>
            @endif      
        @endif      
    @endforeach
</div>