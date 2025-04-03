<div>
    <x-slot name="title">Create Tutorial</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tutorials') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create a new tutorial
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-select label="Actor" name="actor" wire:model.defer="actor">
                    <option value="">--Select a actor--</option>
                    @foreach ($this->actors as $actorKey => $actorName)
                        <option value="{{ $actorKey }}">{{ $actorName }}</option>
                    @endforeach
                </x-select>

                <x-input label="Caption" name="caption" wire:model.defer="caption" optional />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input optional label="Instruction (Youtube Link)" name="instruction_link"
                    wire:model.defer="instruction_link" />

                <x-filepond optional label="Instruction (if any)" name="instruction_attachment"
                    wire:model.defer="instruction_attachment" accept-files="application/pdf"
                    hint="Maximum file size: 2 MB. Allowed file type: PDF" />
            </div>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
