@extends('layouts.master')
@section('content')
@include('_partials.banner')
<section class="main_blogs">
  <div class="main_blogs--cnt">
      <div class="main_blogs--content">
        @foreach($articles as $article)
          @include('_partials.article', ['article' => $article])
        @endforeach
      </div>
  </div>
</section>
@if(count($otherArticles) > 0)
  <section class="other_blogs">
    <div class="other_blogs--cnt">
        <div class="other_blogs--title">
            {!! $section->contents[1]->text_1 !!}
        </div>
        <div class="other_blogs--content">
          @foreach($otherArticles as $article)
            @include('_partials.article', ['article' => $article])
          @endforeach
        </div>
    </div>
  </section>
@endif
@endsection
