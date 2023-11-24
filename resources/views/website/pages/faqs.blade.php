@extends('layouts.master')
@section('content')
@include('_partials.banner')
<section class="questions">
    <div class="questions_cnt">
        <div class="questions_content">
            @foreach($faqsFeatured as $cat)
                @if($cat->faqs()->count() > 0)
                <div class="questions_content--box">
                    <h5>{{ $cat->title }}</h5>
                    <ul>
                        @foreach($cat->faqs as $item)
                        <li class="question_itm">
                            <div class="_toggler">
                                <h6>{{ $item->question }}</h6>
                                <span></span>
                            </div>
                            <div class="_content">
                                {!! $item->answer  !!}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
<section class="questions">
    <div class="questions_cnt">
        <div class="questions_title">
           {!! $section->contents[1]->text_1 !!}
        </div>
        <div class="questions_content">
            @foreach($otherFaqs as $cat)
                @if($cat->faqs()->count() > 0)
                <div class="questions_content--box">
                    <h5>{{ $cat->title }}</h5>
                    <ul>
                        @foreach($cat->faqs as $item)
                        <li class="question_itm">
                            <div class="_toggler">
                                <h6>{{ $item->question }}</h6>
                                <span></span>
                            </div>
                            <div class="_content">
                                {!! $item->answer  !!}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
