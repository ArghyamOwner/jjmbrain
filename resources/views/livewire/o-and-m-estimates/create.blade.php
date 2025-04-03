<div>
    <x-slot name="title">O&M Estimate</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('wucs.show', $wucId) }}">Go Back ({{ $wucName }})
                </x-text-link>
            </x-slot>

            <x-slot:title>
                New O & M Estimate
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">O & M Estimate Details</x-slot>
                <x-slot name="description">Add the necessary details of the estimate.</x-slot>
                <x-select label="Financial Year" name="financial_year_id" wire:model.defer="financial_year_id">
                    <option value="">--Select a financial year--</option>
                    @foreach($this->financialYears as $financialYear)
                    <option value="{{ $financialYear->id }}">{{ $financialYear->financialYear }}</option>
                    @endforeach
                </x-select>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-money label="Manpower (in Rs.)" name="manpower" wire:model.defer="manpower" />
                <x-money label="Maintenance (in Rs.)" name="maintenance" wire:model.defer="maintenance" />
                <x-money label="Electricity (in Rs.)" name="electricity" wire:model.defer="electricity" />
                <x-money label="Chemical (in Rs.)" name="chemical" wire:model.defer="chemical" />
                </div>
                <x-money label="Total Monthly Estimate (in Rs.)" name="total_monthly_estimate"
                    wire:model.defer="total_monthly_estimate" />
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>