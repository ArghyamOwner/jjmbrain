<div>
    <x-slot name="title">Edit News</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('news') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit News
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Share a news</x-slot>
                <x-slot name="description">
                    <ul class="list-disc ml-4 space-y-2">
                        <li>Only departmental achievements, such as the inauguration of a new programme, success stories, and awareness campaigns, may be submitted, and a minimum of 50 words must be written about the news before it is uploaded to the news area.</li>
                        <li>Be cautious when uploading images.</li>
                        <li>Photographs captured from the screen of a mobile device, with the majority of the image covered by a geo-tagging application, as well as images captured from the screens of other devices, are ineligible for publication in the News section.</li>
                    </ul>
                </x-slot>

                <x-textarea label="Title" name="title" wire:model.defer="title" rows="2" />

                @if ($featuredImage)
                    <div class="mb-5">
                        <x-label class="mb-1">Uploaded Image</x-label>
                        <div class="bg-slate-50 rounded-lg border p-2">
                            <div class="w-full h-64 relative">
                                <img src="{{ $featuredImage }}" alt="image" loading="lazy" class="absolute h-full w-full object-contain">
                            </div>
                        </div>
                    </div>
                @endif

                <x-filepond label="Upload/Re-upload an image" name="image" wire:model.defer="image" />

                <x-tinymce-editor toolbar-theme="comment" label="Content" name="description" id="description" wire:model="description" />
               
            </x-card-form>
           
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,image">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>