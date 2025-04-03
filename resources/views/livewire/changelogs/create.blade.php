<div>
    <x-slot name="title">Create Changelogs</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('changelogs') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Changelog
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-input label="Version" name="version" wire:model.defer="version" placeholder="eg. v1.0.1" />
            
            <x-tinymce-editor toolbar-theme="extraminimal" label="Content" name="content" wire:model.defer="content" />

            <x-flatpicker label="Published Date" name="published_date" wire:model.defer="published_date" />
           
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
