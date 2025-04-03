<div>
	<x-section-container-styled align="left" padding="py-6 md:py-12">
        <x-breadcrumb class="text-sm md:text-xl mb-2">
            <x-breadcrumb-item-inverse href="{{ route('helpdesk') }}">All categories</x-breadcrumb-item-inverse>
            <x-breadcrumb-item-inverse href="{{ route('categoryArticles', $categorySlug) }}">{{ $categoryName }}</x-breadcrumb-item-inverse>
            <x-breadcrumb-item-inverse>{{ $articleTitle }}</x-breadcrumb-item-inverse>
        </x-breadcrumb>
    </x-section-container-styled>
 
	<div class="py-10">
        <x-section-centered>
            <x-heading size="3xl" class="font-bold tracking-tight">{{ $articleTitle }}</x-heading>

            <div class="flex items-center justify-between border-t border-b my-6 py-4">
                <div class="text-slate-500">
                    Last updated on {{ $articleLastUpdatedAt }}
                </div>
                <x-social-share class="flex space-x-2 items-center" />
            </div>

            <div class="prose max-w-full prose-sm md:prose-base prose-a:text-blue-600">{{ Str::of($articleContent)->toHtmlString() }}</div>
        </x-section-centered>
    </div> 
</div>
