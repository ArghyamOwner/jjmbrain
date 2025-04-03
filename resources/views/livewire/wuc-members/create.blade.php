<div>
    <x-button tag="a" class="w-full" href="#" color="white" with-icon icon="add" x-data="{}"
        x-on:click.prevent="$dispatch('show-modal', 'create-form')" x-cloak>
        Members
    </x-button>

    <x-modal-simple max-width="2xl" name="create-form" form-action="save">
        <x-slot name="title">Add Details of the Executive Committee & Invited Members of WUC</x-slot>
        <div class="mb-4 mt-2">
            <x-alert variant="error" :close="false">
                Please Note - If a President is already linked to the WUC, 
                the previous President will be restricted, 
                and the newly appointed President will assume an active status.
            </x-alert>
        </div>

        <x-select label="Select Member" name="designation" wire:model="designation">
            <option value="">--Select Designation--</option>
            @foreach ($designations as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </x-select>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <x-input label="Name" name="name" wire:model.defer="name" />

            {{-- <x-input label="Email" type="email" name="email" wire:model.defer="email" /> --}}

            <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone" name="phone"
                wire:model.defer="phone" placeholder="eg. 7896XXXXXX" />
        </div>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
