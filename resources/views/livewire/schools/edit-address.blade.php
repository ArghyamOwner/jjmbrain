<div>
    <x-card overflow-hidden form-action="save">
        <x-card-form :with-shadow="false" no-padding>
            <x-slot name="title">School Address</x-slot>
            <x-slot name="description">Add the district, block, village, and pincode to help people find the school.</x-slot>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-select label="District" name="district" wire:model="district">
                    <option value="">--Select District--</option>
                    @foreach($this->districts as $districtKey => $districtValue)
                        <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                    @endforeach
                </x-select>
                <x-select label="Block" name="block" wire:model.defer="block">
                    <option value="">--Select Block--</option>
                    @foreach($this->blocks as $blockKey => $blockValue)
                        <option value="{{ $blockKey }}">{{ $blockValue }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input type="url" label="Website" name="website" wire:model.defer="website" />
                <x-input label="Phone" name="phone" wire:model.defer="phone" />
            </div>
            <x-input type="email" label="Email" name="email" wire:model.defer="email" />
            <x-input label="Street Address" name="streetAddress" wire:model.defer="streetAddress" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input label="City" name="city" wire:model.defer="city" />
                <x-input label="Village" name="village" wire:model.defer="village" />
                <x-input-number maxlength="6" minlength="6" label="Postal Code" name="postalCode" wire:model.defer="postalCode" />
            </div>
        </x-card-form>

        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>
</div>
