<div>
    <x-slot name="title">Create Notices</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('notices') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Notices
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Share a notice</x-slot>
                <x-slot name="description">
                    {{-- <ul class="list-disc ml-4 space-y-2">
                        <li>Only departmental achievements, such as the inauguration of a new programme, success stories, and awareness campaigns, may be submitted, and a minimum of 50 words must be written about the news before it is uploaded to the news area.</li>
                        <li>Be cautious when uploading images.</li>
                        <li>Photographs captured from the screen of a mobile device, with the majority of the image covered by a geo-tagging application, as well as images captured from the screens of other devices, are ineligible for publication in the News section.</li>
                    </ul> --}}
                </x-slot>

                <x-textarea label="Title" name="title" wire:model.defer="title" rows="2" />

                <x-tinymce-editor toolbar-theme="comment" label="Content" name="description" id="description"
                    wire:model="description" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-select label="Role" name="role" wire:model.defer="role">
                        <option value="">--Select a role--</option>
                        @foreach ($this->roles as $roleKey => $roleValue)
                            <option value="{{ $roleKey }}">{{ $roleValue }}</option>
                        @endforeach
                    </x-select>

                    <x-select label="Type" name="type" wire:model.defer="type">
                        <option value="">--Select a type--</option>
                        @foreach ($this->types as $type)
                            <option value="{{ $type->value }}">{{ $type->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-filepond label="Upload document" name="document" wire:model.defer="document" hint="Maximum file size: 2 MB. Allowed file type: PDF"
                accept-files="application/pdf" />


            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,document">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
