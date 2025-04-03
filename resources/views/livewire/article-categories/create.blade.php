<div>
    <x-slot name="title">Create Article Category</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('articlecategories') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Article Category
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-input label="Category Name" name="name" wire:model.defer="name" />
            <x-textarea label="Category Description" name="description" wire:model.defer="description" />
            <x-input optional label="Icon" name="icon" wire:model.defer="icon" />

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
