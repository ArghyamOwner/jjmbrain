<div>
    <x-slot name="title">ADD ESR Compliance</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $scheme->id) }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                ADD ESR Compliance
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-6">
                <x-select class="grid grid-span-4" label="Status" name="status" wire:model.defer="status">
                    <option value="">--Select Status--</option>
                    @foreach ($this->esrStatus as $key => $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                    @endforeach
                </x-select>
                <x-select class="grid grid-span-4" label="TPI Agency Name" name="tpi_agency_name" wire:model.defer="tpi_agency_name">
                    <option value="">--Select TPI Agency--</option>
                    @foreach ($this->tPIAgencyOptions as $key => $option)
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </x-select>
                <x-input label="TPI Officer Name" name="tpi_officer_name" wire:model.defer="tpi_officer_name" />
                <x-input-number label="TPI Officer Phone" name="tpi_officer_phone" wire:model.defer="tpi_officer_phone"
                    maxlength="10" />

            </div>
            <x-filepond label="Upload Document" wire:model="doc_file" name="doc_file"
            acceptFiles="application/pdf"
                hint="Maximum File Size: 2 MB. File type allowed: PDF only." 
            />
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
