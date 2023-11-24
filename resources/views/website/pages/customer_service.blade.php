@extends('layouts.master')
@push('js')
    <script>
        $('body').addClass('__int');
    </script>
@endpush
@section('content')
@include('_partials.banner')
<section class="help_links">
    <div class="help_links_cnt">
        <div class="hlp_nav">
            {!! $section->contents[1]->text_1 !!}
            <ul>
                @foreach($items as $item)
                    <li>
                        <a href="{{ route('link', $item->slug) }}" class="{{ $record->id == $item->id ? 'active' : '' }}">
                            <img src="{{ asset('img/icons/arrow_link.svg') }}" alt="">
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="hlp_content">
            <div class="hlp_content--itm">
                <h5>{{ $record->title }}</h5>
                {!! $record->text !!}
            </div>
        </div>
    </div>
</section>
@endsection
