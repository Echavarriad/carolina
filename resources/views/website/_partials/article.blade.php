<article class="blog_itm">
	<div class="blog_itm--head">
		<h6>{{ __('titles.blog_and_novelties') }}</h6>
		<small>{{ $article->formatDate() }}</small>
	</div>
	<div class="blog_itm--title">
		<h5 class="cursor" onclick="window.location.href=('{{ route('article', $article->slug) }}')">{{ $article->title }}</h5>
	</div>
	<div class="blog_itm--image cursor" onclick="window.location.href=('{{ route('article', $article->slug) }}')">
		<picture>
		  <x-image image="{{ $article->image_intro }}" alt="{{ $article->alt }}" tit="{{ $article->tit }}" class=""></x-image>
		</picture>
	</div>
	@include('_partials.links_articles', ['url' => route('article', $article->slug)])
</article>