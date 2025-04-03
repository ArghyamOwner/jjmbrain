<div>
	<x-section-container-styled align="left" padding="py-6 md:py-12">
        <x-breadcrumb class="text-sm md:text-xl mb-2">
            <x-breadcrumb-item-inverse href="{{ route('helpdesk') }}">All categories</x-breadcrumb-item-inverse>
            <x-breadcrumb-item-inverse>{{ $categoryName }}</x-breadcrumb-item-inverse>
        </x-breadcrumb>
    </x-section-container-styled>
 
	<div class="py-10">
        <x-section-centered>
            @if($articles->isNotEmpty()) 
                <div class="space-y-4">
                    @foreach($articles as $article)
                        <x-card-stats href="{{ route('articlesShow', $article->slug) }}" tag="a" class="border rounded-xl" shadow="small">
                            <x-heading size="2xl">{{ $article->title }}</x-heading>
                            <p class="mt-2 text-slate-500 leading-6">{{ $article->summary }}</p>
                        </x-card-stats>
                    @endforeach
                </div>
            @else
                <x-card-empty>No articles found under this category.</x-card-empty>
			@endif
        </x-section-centered>
    </div> 
</div>
