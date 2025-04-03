<div>
    <x-slot name="title">Add scheme to workorder</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders.show', $workorderId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Add scheme to workorder
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-8" form-action="save">
            {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-select label="Division" name="division" wire:model="division">
                    <option value="">--Select a division--</option>
                    @foreach($this->divisions as $divisionKey => $divisionValue)
                        <option value="{{ $divisionKey }}">{{ $divisionValue }}</option>
                    @endforeach
                </x-select>
            </div>       --}}
 
            <x-virtual-select 
                label="Select a Scheme" 
                name="scheme" 
                wire:model="scheme" 
                :options="[
                    'options' => $schemes,
                    'multiple' => true,
                    'showValueAsTags' => true,
                ]"
                custom-label
            />
 
            <x-slot name="footer" class="text-right">
                <x-button with-spinner>Assign Scheme</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>