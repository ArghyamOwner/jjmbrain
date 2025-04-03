<x-help-layout title="Help & Support">
	<x-section-centered>
		<div class="py-16 bg-indigo-800 rounded-xl px-4">
			<div class="max-w-2xl mx-auto">
				<livewire:help-search />
			</div>
		</div>

		@if ($categories)
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-10">
				@foreach($categories as $category)
					<x-card-stats href="{{ route('categoryArticles', $category->slug) }}" tag="a" class="border rounded-xl" shadow="small">
						<div class="flex">
							@if ($category['icon'])
								<div class="shrink-0 w-16">
									@svg($category['icon'], 'w-10 h-10 text-indigo-600')
								</div>
							@endif
							<div>
								<div>
									<x-heading size="xl">{{ $category['name'] }}</x-heading>
									{{-- <p class="mt-2 text-slate-500">{{ Str::limit($category['description'], 65) }}</p> --}}
									<p class="mt-2 text-slate-500">{{ $category['description'] }}</p>
								</div>
							</div>
						</div>
					</x-card-stats>
				@endforeach
			</div>
		@endif
	</x-section-centered>
</x-help-layout>