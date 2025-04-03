<div>
    <x-card overflow-hidden form-action="updateUserOffice">
        <x-card-form :with-shadow="false" no-padding>
            <x-slot name="title">Office Details</x-slot>
            <x-slot name="description">Update Office/Circle / Divisions / Subdivisions</x-slot>
 
            <div class="mb-8">
                <x-label class="mb-2">Select Offices / Circles</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($circles as $circle) 
                        <div wire:key="offices-{{ $circle['value'] }}">
                            <x-checkbox 
                                no-margin
                                name="office-{{ Str::slug($circle['label']) }}" 
                                wire:model="offices"
                                value="{{ $circle['value'] }}" 
                                label="{{ $circle['label'] }}"
                            />
                        </div>
                    @endforeach
                </div>
                <x-input-error for="offices" class="mt-2" />
            </div>

            <div class="mb-8">
                <x-label class="mb-2">Select Divisions</x-label>
                @if ($divisionsOptions)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                        @foreach($divisionsOptions as $divisionsOption)
                            <div wire:key="division-{{ $divisionsOption['value'] }}">
                                <x-checkbox 
                                    no-margin
                                    name="division-{{ Str::slug($divisionsOption['label']) }}" 
                                    wire:model="division"
                                    value="{{ $divisionsOption['value'] }}"
                                    label="{{ $divisionsOption['label'] }}"
                                />
                            </div>
                        @endforeach
                    </div>
                    
                    <x-input-error for="division" class="mt-2" />
                @else
                    <p class="text-slate-500 text-sm">Please select office/circle first.</p>
                @endif
            </div>

            <div>
                <x-label class="mb-2">Select Subdivisions</x-label>
                @if ($subdivisionsOptions)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($subdivisionsOptions as $subdivisionsOption)
                        <div wire:key="subdivision-{{ $subdivisionsOption['value'] }}">
                            <x-checkbox 
                                no-margin
                                name="subdivision-{{ Str::slug($subdivisionsOption['label']) }}" 
                                wire:model.defer="subdivision"
                                value="{{ $subdivisionsOption['value'] }}"
                                label="{{ $subdivisionsOption['label'] }}"
                            />
                        </div>
                    @endforeach
                </div>
                <x-input-error for="subdivision" class="mt-2" />
                @else
                    <p class="text-slate-500 text-sm">Please select division first.</p>
                @endif
            </div>
        </x-card-form>

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="updateUserOffice">Save</x-button>
        </x-slot>
    </x-card>
</div>
