<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Update Status</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="update">

                <x-select label="Status" name="status" wire:model="status">
                    <option value="">--Select status--</option>
                    @foreach($this->workorderStatuses as $workorderStatus)
                        <option value="{{ $workorderStatus->value }}">{{ $workorderStatus->name }}</option>
                    @endforeach
                </x-select>
                
                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
