<div>
    <x-slot name="title">Update Litholog</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('lithologs.show', $litholog->id) }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Edit Litholog Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="update">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <x-input type="date" label="Completion Date" name="completion_date"
                        wire:model.defer="completion_date" />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Compressor Pressure" 
                        name="compressor_pressure"
                        wire:model.defer="compressor_pressure" 
                        append-after="(Kg/cm2)"
                        />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Static Water" 
                        name="static_water"
                        wire:model.defer="static_water"
                        append-after="(meters)" 
                        />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Pump Duration (in Hrs.)" 
                        name="duration_pump"
                        wire:model.defer="duration_pump" 
                        append-after="(Hrs.)"
                        />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Discharge" 
                        name="discharge"
                        wire:model.defer="discharge" 
                        append-after="(L/H)"
                        />

                    <x-input-number 
                        input-mode="numeric" 
                        label="Drawdown" 
                        name="drawdown" 
                        wire:model.defer="drawdown" 
                        append-after="(meters)" 
                        />

                    {{-- <x-input label="Status" optional name="status" wire:model.defer="status" /> --}}

                    <x-select label="Status" name="status" wire:model.defer="status">
                        <option value="">--Select an option--</option>
                        <option value="success">Success</option>
                        <option value="failed">Failed</option>
                    </x-select>

                </div>

                {{-- <x-textarea-simple label="Advisory" name="advisory" wire:model.defer="advisory" /> --}}

                <x-textarea-simple label="Comment" name="comment" wire:model.defer="comment" />

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="update">Update</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>