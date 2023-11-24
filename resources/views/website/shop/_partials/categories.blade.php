<div class="_categories">
    <ul class="_categories-content">
        @foreach ($menuCategories as $cat)
            @if ($cat->children->sum('count_products') > 0)
                <li>
                    <button class="{{ $category && $subcategory && $category->id == $cat->id ? '_cat-active' : '' }}">
                        {{ $cat->name }}
                        <span></span>
                    </button>
                    @if ($cat->children->count() > 0)
                        <div class="_links"
                            style="display: {{ $subcategory && $category->id == $cat->id ? 'block' : '' }};">
                            @foreach ($cat->children as $subcat)
                                @if ($subcat->count_products > 0)
                                    <a href="{{ route('products.subcat', [$cat->slug, $subcat->slug]) }}"
                                        class="{{ $subcategory && $subcategory->id == $subcat->id ? '_active' : '' }}">
                                        <span>{{ $subcat->name }}</span>
                                        <span>{{ $subcat->count_products }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
