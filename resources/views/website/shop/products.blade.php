@extends('layouts.master')
@section('content')
@if($category)
    @include('shop._partials.banner')
@else
    @include('_partials.banner')
@endif
<form action="{{ url()->current() }}" id="formFilter" style="display: none">
</form>
<section class="products">
    <div class="products_cnt">
        <button class="_filter-toggler">
            <img src="{{ asset('img/icons/filter.svg') }}" alt="">
            {{ __('links.filter') }}
        </button>
        <div class="products_filter">
            @if(count($params) > 0)
                <a href="{{ url()->current() }}">{{ __('links.clean_filter') }}</a>
            @endif
            <div class="products_filter--wrapper">
                <span class="close_filters">&times;</span>
                <div class="products_filter--head">
                    <h4>{{ __('titles.categories') }}</h4>
                </div>
                <div class="products_filter--content">
                    @include('shop._partials.categories')
                    <div class="_categories">
                            <h6>{{ __('titles.filters') }}</h6>
                            <ul class="_categories-content">
                                @foreach ($attributes as $item) 
                                <li>
                                    <button class="{{ isset($params['color']) ? '_cat-active' : '' }}">
                                        {{ __('titles.filter_by') }} {{ $item->attribute->name }}
                                        <span></span>
                                    </button>
                                    <div class="_links" style="display: {{ isset($params['color']) ? 'block' : '' }}">
                                        @foreach($item->options as $option)
                                            <a class="{{ isset($params['color']) && $params['color'] == $option['id'] ? '_active' : '' }}" href="{{ core()->parseUrlFilter($category, $subcategory, $item->attribute, $option) }}">
                                                <span>{{ $option['name'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        
                    </div>
                    <div class="_categories">
                        <h6>{{ __('titles.prices') }}</h6>
                        <ul class="_categories-content">
                            <li>
                                <button class="{{ isset($params['precio-min']) ? '_cat-active' : '' }}">
                                    {{ __('titles.filter_by_prices') }}
                                    <span></span>
                                </button>
                                <div class="price_field" style="display: {{ isset($params['precio-min']) ? 'block' : '' }}">
                                    <div class="price_content">
                                        <div class="prices">
                                            <label>{{ __('titles.min') }}</label><span id="min-value"></span>
                                        </div>
                                        <div class="prices">
                                            <label>{{ __('titles.max') }}</label><span id="max-value"></span>
                                        </div>
                                    </div>
                                    <div class="range_slider">
                                        <input type="range" min="0" max="{{ $rangePrices['price_max'] }}" value="{{ $valueMinPrice }}" class="range" id="min">
                                        <input type="range" min="0" max="{{ $rangePrices['price_max'] }}" value="{{ $valueMaxPrice }}" class="range" id="max">      
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="products_content">
            @foreach($products as $product)
                @include('shop._partials.product')
            @endforeach
        </div>
        <div class="paginate">
            {{ $products->appends(request()->input())->links('_partials.paginate') }}
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    var minSlider = document.getElementById('min');
    var maxSlider = document.getElementById('max');
    var formFilter = document.getElementById('formFilter');
    
    var outputMin = document.getElementById('min-value');
    var outputMax = document.getElementById('max-value');
    
    outputMin.innerHTML = '$' + minSlider.value;
    outputMax.innerHTML = '$' + maxSlider.value;
    
    minSlider.oninput = function(){
        outputMin.innerHTML= '$' + this.value; 
    }

   
    
    maxSlider.oninput = function(){
        outputMax.innerHTML= '$' + this.value;    
    }

    minSlider.addEventListener('mouseup', function(){
        let valueMinPrice= minSlider.value;
        let valueMaxPrice= maxSlider.value;
        if(valueMinPrice <= valueMaxPrice){
            formFilter.innerHTML ='<input type="hidden" id="price_min" name="precio-min" value="' +
            valueMinPrice + '">';
            formFilter.innerHTML +='<input type="hidden" id="price_max" name="precio-max" value="' +
            valueMaxPrice + '">';
            formFilter.submit();
        }
        
    });

    maxSlider.addEventListener('mouseup', function(){
        let valueMinPrice= minSlider.value;
        let valueMaxPrice= maxSlider.value;
        if(valueMaxPrice >= valueMinPrice){
            formFilter.innerHTML ='<input type="hidden" id="price_min" name="precio-min" value="' +
            valueMinPrice + '">';
            formFilter.innerHTML +='<input type="hidden" id="price_max" name="precio-max" value="' +
            valueMaxPrice + '">';
            formFilter.submit();
        }
    });

    </script>
    
@endpush
