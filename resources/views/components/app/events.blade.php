@if($events->isNotEmpty())
<div class="bg-white pt-16 pb-24 relative overflow-hidden bg-cover bg-center"
	style="background-image: url('{{ url('img/events-bg.jpg') }}')"
>
	<div class="absolute inset-0 bg-white/[.90] bg-gradient-to-tr"></div>

	<x-section-centered class="relative">
		<div class="flex flex-wrap flex-col md:flex-row mb-8 md:space-x-6 space-y-4 md:space-y-0">
			<div>
				<x-heading size="4xl" class="mb-1.5 font-medium font-serif text-purple-700">Latest Events</x-heading>
				<p class="text-slate-700">Events to Look Forward to in Our Town</p>
			</div>
			<div class="md:w-32">
				<x-button color="purple" class="py-3" tag="a" href="{{ route('news.list', [
					'category' => 'events'
				]) }}">More Events<svg
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
			@foreach($events as $event)
				<article class="overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg">
					<a href="{{ isset($tenantId) ? route('news.show', $event->slug) : route('news.show', $event->slug) }}">
						<img alt="Office"
							src="{{ $event->featured_image_url }}"
							class="h-56 w-full object-cover" />
					
						<div class="bg-white p-4 sm:p-6">
							<h3 class="mt-0.5 text-2xl font-medium font-serif text-slate-900">
								{{ $event->title }}
							</h3>
						
							<p class="mt-2 text-sm leading-relaxed text-slate-500 line-clamp-3">
								{{ $event->summary }}
							</p>
						</div>
					</a>
				</article>
			@endforeach
		</div>
	</x-section-centered>
</div>
@endif