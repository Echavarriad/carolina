<section class="breadcrumbs">
    <div class="breadcrumbs_cnt">
        <a href="{{ route('home') }}">Inicio</a>
        @foreach($breadcrumb as $key => $item)
            @if ($item)
                @if($item['url'])
                    <a href="{{ $item['url'] }}">{{ $item['title']}}</a>
                @else
                    <p>{{ $item['title']}}</p>
                @endif      
            @endif      
        @endforeach
    </div>
</section>