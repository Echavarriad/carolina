@if ($paginator->hasPages())
    <div class="box_edco_pager">
         @if (!$paginator->onFirstPage())
            <button onclick="window.location.href=('{{ $paginator->previousPageUrl() }}')">{{ __('links.prev_page') }}
            </button>
        @endif
        <ul>
        @foreach ($elements as $element)
            @if (is_string($element))
                   <li><a>...</a></li>
            @endif
            @if (is_array($element))                
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                       <li class="active"><a>{{ $page }}</a></li>
                    @else
                       <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        </ul>
        @if ($paginator->hasMorePages())
            <button onclick="window.location.href=('{{ $paginator->nextPageUrl() }}')">
                {{ __('links.next_page') }}
            </button>
        @endif
    </div>
@endif