<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Video Details</x-slot>

        <div class="py-4 px-5">
            <form wire:submit.prevent="save">
                <x-input label="Textbook Title" name="title" wire:model.defer="title" /> 
                <x-input optional label="Description" name="description" wire:model.defer="description" placeholder="Author, Edition..." />
                <x-input type="url" label="Video Link" name="link" wire:model.defer="link" />

                <x-label for="image" class="mb-1">Video Image</x-label>
                @if ($imageUrl)
                    <div class="overflow-hidden h-32 w-24 bg-slate-50 mb-2 flex items-center">
                        <img src="{{ $imageUrl }}" alt="video-image" class="w-full h-auto object-fit">
                    </div>
                @endif

                <x-filepond hint="Reupload image" name="image" wire:model="image" />

                <x-button class="w-full mt-5" with-spinner wire:target="save,image">Save</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
