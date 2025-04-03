<div>
    <x-slot name="title">All Articles</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                All Articles
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('articles.create') }}" with-icon icon="add">New Article</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-input-search wire:model.debounce.500ms="search" placeholder="Search..." class="w-full md:w-1/2 mb-4" />

        @if($articles->isNotEmpty())
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            {{-- <x-table.thead>URL</x-table.thead> --}}
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Published at</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <x-table.tdata>
                                    {{ $article->title }}
                                </x-table.tdata>
                                {{-- <x-table.tdata>
                                    {{ $article->slug }}
                                </x-table.tdata> --}}
                                <x-table.tdata>
                                    <x-badge :withdot="false" variant="{{ $article->status_color }}">{{ $article->status }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $article->published_at }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="{{ route('articles.edit', $article->id) }}" />
    
                                        <x-button-icon-delete 
                                            x-on:click.prevent="$wire.emitTo(
                                                'article.delete',
                                                'showDeleteModal',
                                                '{{ $article->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove the article?'
                                            )"
                                        />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            @if ($articles->hasPages())
            <div class="mt-5">{{ $articles->links() }}</div>
            @endif
        @else 
            <x-card-empty />
        @endif
    </x-section-centered>

    <livewire:article.delete />
</div>