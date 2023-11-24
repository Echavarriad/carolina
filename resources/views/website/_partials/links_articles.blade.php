<div class="_links">
    <a href="{{ $url }}">
        {{ __('links.read_more') }}
        <img src="{{ asset('img/icons/link.svg') }}" alt="">
    </a>
    <div class="_share">
        <button>
            {{ __('links.share') }}
            <img src="{{ asset('img/icons/share.svg') }}" alt="">
        </button>
        <div class="_share-content">
            <a class="cursor btn_share_facebook" data-url="{{ $url }}" rel="noopener noreferrer">
                <img src="{{ asset('img/icons/facebook.svg') }}" alt="">
            </a>
            <a class="cursor btn_share_whatsapp" data-url="{{ $url }}" rel="noopener noreferrer">
                <img src="{{ asset('img/icons/whatsapp.svg') }}" alt="">
            </a>
        </div>
    </div>
</div>