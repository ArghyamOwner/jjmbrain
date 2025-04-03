<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Close Issue</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="save">

                <x-select label="Status" name="status" wire:model.defer="status">
                    <option value="" selected>--Status--</option>
                    @foreach ($statuses as $typekey => $typeValue)
                        <option value="{{ $typekey }}">{{ Str::title($typeValue) }}</option>
                    @endforeach
                </x-select>

                <x-textarea-simple label="Remarks" name="remarks" wire:model.defer="remarks" />

                <x-button with-spinner wire:target="save">Save</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
