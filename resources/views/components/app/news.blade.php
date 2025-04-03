@if($news->isNotEmpty())
<div class="bg-white pt-16 pb-20 relative overflow-hidden">
	<div class="absolute inset-0 text-indigo-100 z-10" style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="absolute z-20 left-0 top-0 w-full bg-gradient-to-b from-white h-3/4"></div>
    <div class="absolute z-20 bottom-0 w-full bg-gradient-to-t from-white h-2/3"></div>

	<x-section-centered class="relative z-20">
		<div class="flex flex-wrap flex-col md:flex-row mb-8 md:space-x-6 space-y-4 md:space-y-0">
			<div>
				<x-heading size="4xl" class="mb-1.5 font-medium font-serif text-sky-700">Latest News</x-heading>
				<p class="text-slate-700">The news about recent activities and developments.</p>
			</div>
			<div class="md:w-32">
				<x-button class="py-3" tag="a" href="{{ route('news.list') }}">More News<svg
					xmlns="http://www.w3.org/2000/svg" class="shrink-0 ml-1 w-5 h-5 -rotate-45" width="24" height="24"
					viewBox="0 0 24 24">
					<g fill="none">
						<path d="M4 12h16m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round"></path>
					</g>
				</svg></x-button>
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			@foreach($news as $newsArticle)
				<article class="overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg">
					<a href="{{ isset($tenantId) ? route('news.show', $newsArticle->slug) : route('news.show', $newsArticle->slug) }}">
						<img alt="Office"
							src="{{ $newsArticle->featured_image_url }}"
							class="h-48 w-full object-cover" />
					
						<div class="bg-white p-4 sm:p-6">
							<time datetime="2022-10-10" class="block text-xs text-slate-500">
								@date($newsArticle->created_at)
							</time>
					
							<h3 class="mt-0.5 text-2xl font-medium font-serif text-slate-900">
								{{ $newsArticle->title }}
							</h3>
						
					
							<p class="mt-2 text-sm leading-relaxed text-slate-500 line-clamp-3">
								{{ $newsArticle->summary }}
							</p>
						</div>
					</a>
				</article>
			@endforeach
		</div>
	</x-section-centered>
</div>
@endif