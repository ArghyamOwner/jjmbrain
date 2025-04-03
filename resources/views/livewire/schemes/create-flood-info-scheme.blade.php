<div>
    <x-slot name="title">ADD Flood Info</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                ADD Flood Info
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
       @if ($message)
            <x-alert variant="error" class="mb-4">
                {{ $message }}
            </x-alert>
       @endif

        <x-card form-action="save">
            {{-- <x-card-form :with-shadow="false" no-padding > 
                <x-slot name="title">Today Flood Details</x-slot> --}}
                {{-- <x-slot name="description">Add the necessary details like division, district, block...</x-slot> --}}
            {{-- </x-card-form> --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-6">
                <x-select class="grid grid-span-4" label="Severity" name="severity" wire:model.defer="severity">
                    <option value="">--Select a Severity--</option>
                    @foreach ($severityOptions as $key => $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </x-select>
                {{-- <x-select label="Partial Damage" name="partial_damage" wire:model.defer="partial_damage">
                    <option value="">--Select a Partial Damage--</option>
                    @foreach ($partialDamageItems as $key => $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </x-select> --}}
                <x-input-number input-mode="numeric" label="Approx Inundation Height (in Meter)" name="approx_inundation_height" wire:model.defer="approx_inundation_height" />
                <x-input type="date" label="Inundation Start Date" name="start_date" wire:model.defer="start_date" />
                <x-input-number input-mode="numeric" label="Water Stagnation Period (in days)" name="water_stagnation_period" wire:model.defer="water_stagnation_period" />
            </div>
            <div class="mb-8">
                <x-label class="mb-2">Select Partial Damage</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 justify-items-start">
                    @foreach ($partialDamageItems as $key => $item)
                        <div wire:key="inundated-{{ $item }}">
                            <x-checkbox no-margin name="inundated-{{ Str::slug($item) }}"
                                wire:model.defer="partial_damage" value="{{ $key }}"
                                label="{{ $item }}" />
                        </div>
                    @endforeach
                    <x-input-error for="partial_damage" />
                </div>
            </div>
            <div class="mb-8">
                <x-label class="mb-2">Select Inundated Infrastructures</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2">
                    @foreach ($getInundatedInfrastructures as $key => $inundated)
                        <div wire:key="inundated-{{ $inundated }}">
                            <x-checkbox no-margin name="inundated-{{ Str::slug($inundated) }}"
                                wire:model.defer="inundated_infrastructure" value="{{ $key }}"
                                label="{{ $inundated }}" />
                        </div>
                    @endforeach
                    <x-input-error for="inundated_infrastructure" />
                </div>
            </div>
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
