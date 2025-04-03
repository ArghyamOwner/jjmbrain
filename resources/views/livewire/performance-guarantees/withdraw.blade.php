<div>
    <x-slot name="title">Withdraw Performance Guarantee</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders.show', $workorderId) }}">Go Back to workorder</x-text-link>
            </x-slot>

            <x-slot:title>
                Withdraw Performance Guarantee
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-select label="Office" name="office" wire:model.defer="office">
                    <option value="">--Select an office--</option>
                    @foreach($this->offices as $officeKey => $officeName)
                        <option value="{{ $officeKey }}">{{ $officeName }}</option>
                    @endforeach
                </x-select>
            </div>
 
            <x-input label="Letter Number" name="letterNumber" wire:model.defer="letterNumber" />
            
            <x-input label="Received By" name="receivedBy" wire:model.defer="receivedBy" />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-input type="date" label="Withdraw Date" name="withdrawDate" wire:model.defer="withdrawDate" />
            </div>

            <x-filepond label="Upload NOC/NLC Scanned Copy" name="nocCopy" wire:model.defer="nocCopy" />

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,nocCopy">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>