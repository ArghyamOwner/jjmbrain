<div>
    <div class="flex justify-between items-center space-x-2 mb-1">
        <x-heading size="md">Latest News</x-heading>
        <div class="px-4">
            <x-text-link href="{{ route('news.feeds') }}" class="text-sm">View all</x-text-link>
        </div>
    </div>
     
    <x-card no-padding>
        <div class="divide-y" wire:init="getFeeds">
            @if ($feeds)
                @foreach($feeds as $feed)
                    <x-media class="py-2 px-4">
                        {{-- <x-slot name="mediaObject">
                            <img src="{{ $feed->newsimage_url }}" loading="lazy" class="w-16 h-16 object-fit rounded" />
                        </x-slot> --}}
                        <x-slot name="mediaBody">
                            <p class="text-sm line-clamp-2 mb-1 leading-4 font-medium text-slate-700">{{ $feed->title }}</p>
                            <p class="truncate text-xs text-slate-500">{{ $feed->user->name }}</p>
                            <p class="truncate text-xs text-slate-500">{{ $feed->news_created_since }}</p>
                        </x-slot>
                    </x-media>
                @endforeach
            @else
                @foreach(range(1, 3) as $range)
                    <x-media class="py-2 px-4">
                        <x-slot name="mediaObject">
                            <div class="h-16 w-16 rounded bg-slate-100"></div>
                        </x-slot>
                        <x-slot name="mediaBody">
                            <div class="mb-3 h-4 rounded bg-slate-100"></div>
                            <div class="h-3 mb-1 w-2/3 rounded bg-slate-200"></div>
                            <div class="h-3 w-1/2 rounded bg-slate-100"></div>
                        </x-slot>
                    </x-media>
                @endforeach
            @endif
        </div>
    </x-card>
</div>
