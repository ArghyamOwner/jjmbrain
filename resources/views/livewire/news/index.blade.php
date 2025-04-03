<div>
    <x-slot name="title">All News</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                News
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('news.create') }}" with-icon icon="add">Share News</x-button> 
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search news..." />
                </div>
            </div>

            @if($news->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Image / Title / Author</x-table.thead>
                                <x-table.thead>Status</x-table.thead>
                                <x-table.thead>Created on</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $newsFeed)
                                <tr>
                                    <x-table.tdata>
                                        <x-media>
                                            <x-slot name="mediaObject">
                                                <img 
                                                    src="{{ $newsFeed->newsimage_url }}" 
                                                    alt="news-image" 
                                                    loading="lazy"
                                                    class="w-20 h-16 object-fit rounded"
                                                >
                                            </x-slot>
                                            <x-slot name="mediaBody">
                                                {{-- <div class="md:w-[420px]"> --}}
                                                    <x-heading size="md" class="truncate mb-1">{{ $newsFeed->title }}</x-heading>
                                                {{-- </div> --}}
                                                <p class="text-sm text-slate-500 truncate">{{ $newsFeed->user->name }}</p>
                                                <p class="text-xs text-slate-500 truncate">{{ $newsFeed->user->email }}</p>
                                                
                                            </x-slot>
                                        </x-media>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-badge variant="{{ $newsFeed->news_status_color }}">{{ $newsFeed->news_status }}</x-badge>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @date($newsFeed->created_at)
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-edit href="{{ route('news.edit', $newsFeed->id) }}" />
                                            <x-button-icon-delete 
                                                href="#" 
                                                x-data=""
                                                x-cloak
                                                x-on:click.prevent="$wire.emitTo(
                                                    'news.delete',
                                                    'showDeleteModal',
                                                    '{{ $newsFeed->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this news details?',
                                                    '{{ $newsFeed->title }}'
                                                )"
                                            />
                                        </div>
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>

                <livewire:news.delete />
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($news->hasPages())
            <div class="mt-5">{{ $news->links() }}</div>
        @endif
    </x-section-centered>
</div>