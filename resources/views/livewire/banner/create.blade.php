<div>
    <x-slot name="title">Create Banner</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('banners') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Add a new Banner
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input optional label="Banner Title" name="title" wire:model.defer="title" />

                    <x-select label="App Name" name="app_name" wire:model="app_name">
                        <option value="">--Select an option--</option>
                        @foreach ($appOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </x-select>
                </div>

                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> --}}
                    <x-filepond 
                        label="Banner image"
                        wire:model="image" 
                        name="image"
                        accept="image/jpg,image/jpeg,image/png"
                        hint="Maximum File Size: 2 MB. File types allowed: JPG, JPEG, PNG."
                    />
                {{-- </div> --}}
            
                <x-textarea-simple optional label="Link" name="link" wire:model.defer="link" />

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save,document">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
