<div>
    <x-card form-action="saveFeaturedImage">
        <x-card-form class="shadow-none" no-padding>
            <x-slot name="title">Featured Image</x-slot>
            <x-slot name="description">Your feature image must be a PNG or JPEG, up to 2 MB.</x-slot>
            
            @if ($featuredImagePath)
                <img 
                    src="{{ $featuredImagePath }}"
                    loading="lazy"
                    class="w-auto h-64 border rounded-lg"
                />
            @else
                <x-filepond
                    name="featuredImage"
                    wire:model.defer="featuredImage"
                />
            @endif
        </x-card-form>

        <x-slot name="footer" class="text-right">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            @if ($featuredImagePath)
                <livewire:admin.pages.featured-image-delete />
                <x-button
                    type="button"
                    color="white"
                    class="text-red-600"
                    with-spinner
                    x-data="{}"
                    x-cloak
                    x-on:click="$wire.emitTo(
                        'admin.pages.featured-image-delete',
                        'showDeleteModal',
                        '{{ $pageId }}',
                        'Confirm Deletion',
                        'Are you sure you want to remove the image?'
                    )"
                >Delete Featured Image</x-button>
            @else
                <x-button
                    color="black"
                    with-spinner
                    wire:target="saveFeaturedImage,featuredImage"
                >Save Featured Image</x-button>
            @endif
        </x-slot>
    </x-card>
   
    @include('partials.js._filepond-scripts')
</div>
