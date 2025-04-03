<div>
    <x-card no-padding overflow-hidden>
            
        @if($textbooks->isNotEmpty())
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search textbooks..." />
                </div>

                <div>
                    <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'textbook-create-form')" x-cloak>New Textbook</x-button> 
                </div>
            </div>

            <div class="p-4 mb-5 grid grid-cols-1 md:grid-cols-5 gap-6">
                @foreach($textbooks as $textbook)
                    <div class="border rounded-md overflow-hidden">
                        <div class="shrink-0 h-48 w-full mx-auto bg-slate-50 overflow-hidden">
                            <img src="{{ $textbook->textbook_image_url }}" alt="" class="object-fit w-full h-48">
                        </div>
                        <div class="p-2">
                            <x-heading size="md" class="truncate block">{{ $textbook->textbook_title }}</x-heading>
                            <p class="text-slate-500 text-sm mb-3">{{ $textbook->subject?->class?->class_name }}</p>

                            <div class="flex space-x-2 border-t pt-2">
                                <x-button-icon 
                                    x-data="{ tooltip: 'Download' }" x-tooltip="tooltip"
                                    download href="{{ $textbook->textbook_link }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                      </svg>
                                </x-button-icon>
                                <x-button-icon-edit 
                                    href="#" 
                                    x-on:click.prevent="livewire.emitTo('subjects.edit-textbook','showEditTextbookSlideover', '{{ $textbook->id }}')" 
                                />
                                
                                <x-button-icon-delete href="#" />

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
             
            {{ $textbooks->links() }}
        @else 
            <x-card-empty class="shadow-none" variant="">
                <p class="text mb-3 text-slate-400">No textbooks found.</p>
                <x-button tag="a" href="#" with-icon icon="add" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'textbook-create-form')" x-cloak>Add a new textbook</x-button>
            </x-card-empty>
        @endif
    </x-card>

    <livewire:subjects.edit-textbook />

    <x-modal-simple max-width="md" name="textbook-create-form" form-action="save">
        <x-slot name="title">Create new textbook</x-slot>

        <x-input label="Title" name="title" wire:model.defer="title" />
        <x-input optional label="Description" name="description" wire:model.defer="description" placeholder="Author, Edition..." />
        <x-input type="url" label="Download Link" name="link" wire:model.defer="link" />
        <x-filepond label="Book Image" name="image" wire:model="image" />

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save,image">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
