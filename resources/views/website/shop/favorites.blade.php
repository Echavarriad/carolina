@extends('layouts.master')
@section('content')
@include('_partials.banner')
<section class="products">
    <div class="products_cnt">
        <div class="products_content">
            @foreach($products as $product)
                @include('shop._partials.product')
            @endforeach
        </div>
    </div>
</section>
@endsection
