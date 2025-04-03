<div>
    <div class="text-right p-1">
        {{-- <x-button class="truncate" tag="a" href="#" color="white" with-icon icon="add" x-data="{}"
            x-on:click.prevent="$dispatch('show-modal', 'water-level-form')" x-cloak>Add
        </x-button> --}}

        <x-button-icon-add href="#" x-on:click.prevent="$dispatch('show-modal', 'water-level-form')" />
    </div>

    <x-modal-simple max-width="2xl" name="water-level-form" form-action="save">
        <x-slot name="title">Add Water Level Details to Litholog</x-slot>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
            <x-select label="Layer" name="pattern_id" wire:model.defer="pattern_id">
                <option value="">--Select a layer--</option>
                @foreach ($this->patterns as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </x-select>
            <x-input-number readonly input-mode="numeric" label="Start" name="start" wire:model.defer="start" />
            <x-input-number input-mode="numeric" label="End" name="end" wire:model.defer="end" />
            {{--
            <x-input label="Type" name="type" wire:model.defer="type" /> --}}
        </div>
        <x-textarea-simple label="Remarks" name="remarks" wire:model.defer="remarks" />


        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>