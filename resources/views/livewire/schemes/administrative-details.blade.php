<div>
    <x-card-form form-action="save">
        <x-slot name="title">Scheme Administrative Details</x-slot>
        <x-slot name="description">Add/Update the necessary details like division, district, block...</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <x-select label="Division" name="division" wire:model="division">
                <option value="">--Select a division--</option>
                @foreach ($this->divisions as $divisionKey => $divisionName)
                <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                @endforeach
            </x-select>

            <x-select label="Sub-Division" name="subdivision_id" wire:model.defer="subdivision_id">
                <option value="">--Select a Sub-Division--</option>
                @foreach ($subdivisions as $subdivisionKey => $subdivisionName)
                <option value="{{ $subdivisionKey }}">{{ $subdivisionName }}</option>
                @endforeach
            </x-select>

            
            <div class="md:col-span-2 mb-8">
                <x-select label="District" name="district" wire:model="district">
                    <option value="">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                    <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>
                <x-label class="mb-2">Select Block(s)</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($blocks as $block)
                    <div wire:key="blocks-{{ $block['value'] }}">
                        <x-checkbox no-margin name="blocks-{{ Str::slug($block['label']) }}" wire:model="block_id"
                            value="{{ $block['value'] }}" label="{{ $block['label'] }}" />
                    </div>
                    @endforeach
                </div>
                <x-input-error for="block_id" class="mt-2" />
            </div>

            <div class="md:col-span-2 mb-8">
                <x-label class="mb-2">Select Panchayat(s)</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($panchayats as $panchayat)
                    <div wire:key="panchayat-{{ $panchayat['value'] }}">
                        <x-checkbox no-margin name="panchayat-{{ Str::slug($panchayat['label']) }}"
                            wire:model="panchayat_ids" value="{{ $panchayat['value'] }}"
                            label="{{ $panchayat['label'] }}" />
                    </div>
                    @endforeach
                </div>
                <x-input-error for="panchayat_ids" class="mt-2" />
            </div>

            <div class="md:col-span-2 mb-8">
                <x-label class="mb-2">Select Village(s)</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($villages as $village)
                    <div wire:key="village-{{ $village['value'] }}">
                        <x-checkbox no-margin name="village-{{ Str::slug($village['label']) }}" wire:model="village_ids"
                            value="{{ $village['value'] }}" label="{{ $village['label'] }}" />
                    </div>
                    @endforeach
                </div>
                <x-input-error for="village_ids" class="mt-2" />
            </div>

            <div class="md:col-span-2 mb-8">
                <x-label class="mb-2">Select Habitation(s)</x-label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-2">
                    @foreach($habitations as $habitation)
                    <div wire:key="habitation-{{ $habitation['value'] }}">
                        <x-checkbox no-margin name="habitation-{{ Str::slug($habitation['label']) }}"
                            wire:model="habitation_ids" value="{{ $habitation['value'] }}"
                            label="{{ $habitation['label'] }}" />
                    </div>
                    @endforeach
                </div>
                <x-input-error for="habitation_ids" class="mt-2" />
            </div>
        </div>

        <x-virtual-select 
            label="LAC" 
            name="lac_id" 
            wire:model.defer="lac_id" 
            :options="[
                'options' => $this->lacs,
                'selectedValue' => $lac_id
            ]" 
        />

        <x-slot name="footer" class="text-right">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card-form>
</div>