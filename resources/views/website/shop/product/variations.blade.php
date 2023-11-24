@inject ('configVariationsHelper', 'App\Shop\Helpers\ConfigVariations')
@php
   	$attributes = $configVariationsHelper->getConfigurationConfig($product);
   	$variations = $configVariationsHelper->getConfigVariations($product); 
    $index= 1 + $product->gallery()->count();
    foreach($variations as $variation){
        $variation->index_for_gallery= $index;
        $index++;
    }
    //dd($attributes);
@endphp
<variations inline-template :product="{{ json_encode($product) }}" :data_attributes="{{ json_encode($attributes) }}" :variations="{{ json_encode($variations) }}" :content="{{ json_encode(__('content_vue')) }}"  v-on:changegif="activeGif" v-on:changevar="selectedVariation">    
        <div class="_sizes" v-for="attr in attributes"  >
            <select class="change-gallery" v-on:change="changeSelection($event, attr)">
                <option selected disabled>@{{ attr.name_filter }}</option>
                <option :value="option.id" v-for="option in attr.options" :data-index="option.index_for_gallery">@{{ option.name }}</option>
            </select>
        </div>
</variations>