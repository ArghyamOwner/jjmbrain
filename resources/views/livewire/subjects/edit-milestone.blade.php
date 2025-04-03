<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Milestone Details</x-slot>

        <div class="py-4 px-5">
            <form wire:submit.prevent="save">
                <x-input label="Milestone Title" name="milestoneTitle" wire:model.defer="milestoneTitle" /> 
                
                {{-- <x-select label="Status" name="milestoneStatus" wire:model.defer="milestoneStatus">
                    <option value="">--Select status--</option>
                    @foreach ($this->milestoneStatuses as $status)
                    <option value="{{ $status }}">{{ Str::title($status) }}</option>
                    @endforeach
                </x-select>     --}}

                <x-button class="w-full" with-spinner wire:target="save">Save</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
