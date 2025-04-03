<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Update Status</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="update">

                <x-select label="Status" name="status" wire:model="status">
                    <option value="">--Select status--</option>
                    @foreach($this->schemeStatuses as $schemeStatus)
                        <option value="{{ $schemeStatus->value }}">{{ $schemeStatus->name }}</option>
                    @endforeach
                </x-select>

                @if($status === 'handed-over')
                    <x-input
                        type="date" 
                        label="Handover Date" 
                        name="handoverDate" 
                        wire:model.defer="handoverDate" 
                    />
                @endif

                <x-button with-spinner wire:target="update">Update</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
