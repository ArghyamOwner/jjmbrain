<div>
    @if ($images->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-card class="flex items-center h-full justify-center" overflow-hidden>
            <div class="w-full h-full text-slate-100/50 inset-x-0 -ml-px -mt-px top-0 absolute"
                style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 20px 20px;">
            </div>
            <div class="w-full h-full right-0 top-0 absolute bg-gradient-to-tl from-white"></div>

            <div class="text-center relative">
                <p class="mb-4 text-sm text-slate-500">Add image to the scheme gallery.</p>
                <x-button type="button" with-icon icon="add" x-data=""
                    x-on:click.prevent="$dispatch('show-modal', 'image-created-modal')" x-cloak>Add Image</x-button>
            </div>
        </x-card>

        @foreach($images as $image)
        <x-lightbox>
            <x-lightbox.item image-url="{{ $image->image_url }}" image-caption="{{ $image->caption }}">
                <x-card no-padding overflow-hidden>
                    <div class="bg-slate-50 h-48 w-full">
                        <img src="{{ $image->image_url }}" alt="{{ $image->caption }}" class="object-fit h-48 mx-auto"
                            loading="lazy">
                    </div>

                    <div class="px-2 py-2 border-t border-slate-100 flex justify-between">
                        <div class="flex-1 pr-2">
                            <div class="text-sm line-clamp-2 mb-1 text-slate-700">
                                {{ $image->caption ?? 'No title' }}
                            </div>

                            <p class="text-xs text-slate-500">@date($image->created_at)</p>
                        </div>

                        <div class="shrink-0 flex flex-col border-l w-10 items-center">
                            <x-button-icon-edit href="#"
                                x-on:click.prevent="$wire.emitTo('galleries.edit', 'showGalleryEdit', '{{ $image->id }}')" />
                            <x-button-icon-delete href="#" x-data="{}" x-cloak x-on:click.prevent="$wire.emitTo(
                                            'galleries.delete',
                                            'showDeleteModal',
                                            '{{ $image->id }}',
                                            'Confirm Deletion',
                                            'Are you sure you want to remove the image?'
                                        )" />
                        </div>
                    </div>
                </x-card>
            </x-lightbox.item>
        </x-lightbox>
        @endforeach
    </div>

    <livewire:galleries.delete />
    <livewire:galleries.edit />
    @else
    <x-card-empty variant="">
        <p class="mb-4 text-sm">No images added yet.</p>
        <x-button type="button" with-icon icon="add" x-data=""
            x-on:click.prevent="$dispatch('show-modal', 'image-created-modal')" x-cloak>Add Image</x-button>
    </x-card-empty>
    @endif

    <x-modal-simple name="image-created-modal" form-action="save">
        <x-slot name="title">Gallery Image</x-slot>

        <x-filepond label="Image" name="image" wire:model.defer="image" />
        <x-input label="Image Caption" name="caption" wire:model.defer="caption" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <x-select label="Image Type" name="image_type" wire:model.defer="image_type">
                <option value="">--Select a type--</option>
                @foreach($this->galleryTypes as $galleryType)
                <option value="{{ $galleryType->value }}">{{ $galleryType->name }}</option>
                @endforeach
            </x-select>
            <x-select label="Image Tag" name="tag" wire:model.defer="tag">
                <option value="">--Select a Tag--</option>
                @foreach($tags as $tag)
                <option value="{{ $tag }}">{{ $tag }}</option>
                @endforeach
            </x-select>
        </div>

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="save,image">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>