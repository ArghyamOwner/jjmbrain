<div>
    <x-section-container-styled align="left" padding="py-5">
        <x-text-link href="{{ route('news.list') }}" color="white" with-back-icon>Back to all news</x-text-link>
    </x-section-container-styled>
 
	<div class="py-10">
        <x-section-centered>
            <x-heading size="4xl" class="font-semibold text-slate-800 mb-2.5 font-serif">{{ $title }}</x-heading>
            <p class="text-gray-600 text-sm mb-6 flex flex-wrap space-x-3 items-center">
                <span>{{ $publishedOn }}</span>
                <span class="h-2 w-2 bg-slate-300 rounded-full"></span>
                <span>{{ Str::readDuration(strip_tags($content)) }} min read</span>    
                <span class="h-2 w-2 bg-slate-300 rounded-full"></span>
                <a href="{{ route('news.list') }}?category={{ $category }}"  class="hover:underline underline-offset-2 text-purple-600 uppercase text-xs inline-block font-semibold tracking-wider">{{ $category }}</a>
            </p>
            
            @if($featuredImageUrl)
                <div class="h-48 md:h-[500px] bg-gray-100 mb-10 rounded-lg overflow-hidden">
                    <img src="{{ $featuredImageUrl }}" alt="image" loading="lazy" class="w-full h-48 md:h-[500px] object-cover">
                </div>
            @endif

            <div class="max-w-4xl mx-auto">
                @if ($category === 'events')
                    <p class="mb-4 text-purple-600">{{ $summary }}</p>
                @endif

                <div class="mb-8 prose prose-slate prose-a:text-sky-600 max-w-none prose-blockquote:not-italic prose-blockquote:text-sky-600">
                    {!! str_replace('<p><br></p>', '', $content) !!}
                </div>
            
                <x-social-share />
            </div>
        </x-section-centered>
    </div>
</div>
