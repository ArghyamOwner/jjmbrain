<div>
	<x-section-container-styled
		align="left"
		heading="Latest News"
		subheading="The news about recent activities and developments."
	/>
 
	<div class="py-10">
        <x-section-centered>
			<div class="mb-6 flex flex-wrap space-x-4">
				<a href="{{ route('news.list') }}" class="{{ url()->full() === route('news.list') ? 'text-sky-700 underline underline-offset-2' : 'text-slate-700' }}">All</a>
				@foreach($categories as $newscategory)
					<a
						class="{{ $newscategory->value === $category ? 'text-sky-700 underline underline-offset-2' : 'text-slate-700' }}"
						href="{{ route('news.list') }}?category={{ $newscategory->value }}" 
						wire:click.prevent="filterByCategory('{{ $newscategory->value }}')"
					>{{ Str::title($newscategory->name) }}</a>
				@endforeach
			</div>

            @if($allnews->isNotEmpty()) 
				<div class="grid grid-cols-1 md:grid-cols-3 gap-8">	
					@foreach($allnews as $newsArticle)
						<article class="overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg">
							<a href="{{ route('news.show', $newsArticle->slug) }}">
								<div class="relative h-48">
									<img alt="Office"
										src="{{ $newsArticle->featured_image_url }}"
										class="h-48 w-full object-cover" />

									<div class="z-10 h-16 flex items-end absolute left-0 right-0 bottom-0 bg-gradient-to-t from-slate-800">
										<p class="px-4 md:px-6 pb-4 text-purple-400 uppercase font-semibold text-xs tracking-widest">{{ $newsArticle->category }}</p>
									</div>
								</div>
							
								<div class="bg-white p-4 sm:p-6">
									<time datetime="2022-10-10" class="block text-xs text-slate-500">
										@date($newsArticle->created_at)
									</time>
									
									<h3 class="mt-0.5 text-2xl font-semibold font-serif text-slate-900">
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

				<div class="my-6">
					{{ $allnews->links() }}
				</div>
			@endif
        </x-section-centered>
    </div> 
</div>
