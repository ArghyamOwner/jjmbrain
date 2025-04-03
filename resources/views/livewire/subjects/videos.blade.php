<div>
    <x-card no-padding overflow-hidden>
        @if($videos->isNotEmpty())
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search videos..." />
                </div>

                <div>
                    <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'videos-create-form')" x-cloak>New video</x-button>
                </div>
            </div>

            <x-table.table :rounded="false">
                <thead>
                    <tr>
                        <x-table.thead>Title</x-table.thead>
                        <x-table.thead>Download</x-table.thead>
                        <x-table.thead>Actions</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <x-table.tdata>
                                <div class="flex">
                                    <div class="shrink-0 mr-2 h-20 w-20 rounded bg-slate-50 overflow-hidden flex items-center">
                                        <img src="{{ $video->video_image_url }}" alt="" class="object-fit">
                                    </div>
                                    <div>
                                        <x-heading size="md">{{ $video->video_title }}</x-heading>
                                        <p class="text-slate-500 text-sm">{{ $video->class->class_name }}</p>
                                    </div>
                                </div>
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-text-link download href="{{ $video->video_link }}">Download</x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-edit 
                                        href="#" 
                                        x-on:click.prevent="livewire.emitTo('subjects.edit-video','showEditVideoSlideover', '{{ $video->id }}')" 
                                    />
                                </div>
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>

            {{ $videos->links() }}
        @else 
            <x-card-empty class="shadow-none" variant="">
                <p class="text mb-3 text-slate-400">No videos found.</p>
                <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'videos-create-form')" x-cloak>Add a new video</x-button>
            </x-card-empty>
        @endif
    </x-card>

    <livewire:subjects.edit-video />

    <x-modal-simple max-width="md" name="videos-create-form" form-action="save">
        <x-slot name="title">Add new video</x-slot>

        <x-input label="Title" name="title" wire:model.defer="title" />
        <x-input optional label="Description" name="description" wire:model.defer="description" placeholder="Author, Edition..." />
        <x-input type="url" label="Video Link" name="link" wire:model.defer="link" />
        <x-filepond label="Video Image" name="image" wire:model="image" />

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save,image">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
