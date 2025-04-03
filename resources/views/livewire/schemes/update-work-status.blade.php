<div>
    <x-slot name="title">Update Status</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Update Status
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-4 space-y-5">
            <x-alert variant="error" :close="false">
                Conditions to Handover a Scheme :
                <ul style="list-style-type:disc;">
                    <li>The Scheme must be Verified.</li>
                    <li>ASEB Consumer Number must be Updated. (Not Required in case the Scheme's Energy Type is Solar or Gravity)</li>
                    <li>Jalmitra must be Added (Not Required in case the Scheme's Planned FHTC is below 50)</li>
                    <li>Scheme Operational/Functional status should be operative before handing over</li>
                </ul>
            </x-alert>
        </div>

        <x-card-form form-action="update">
            <x-slot name="title">Update Status</x-slot>
            <x-slot name="description">Add the necessary details.</x-slot>

            <x-select label="Status" name="status" wire:model="status">
                <option value="">--Select status--</option>
                @foreach($this->schemeStatuses as $schemeStatus)
                <option value="{{ $schemeStatus->value }}">{{ $schemeStatus->name }}</option>
                @endforeach
            </x-select>

            @if($show)
            <x-input type="date" label="Handover Date" name="handoverDate" wire:model.defer="handoverDate" />

            <x-filepond accept-files="application/pdf" label="Upload Handed-Over Document" name="handoverDocument"
                wire:model.defer="handoverDocument" />
            @endif


            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="updated">Updated.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="update">Update</x-button>
            </x-slot>
        </x-card-form>

    </x-section-centered>
</div>