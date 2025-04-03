<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Assign Task</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="save">

                <x-select label="Role" name="role" wire:model="role">
                    <option value="" selected>--Select--</option>
                    @foreach ($this->roles as $rolekey => $roleValue)
                        <option value="{{ $rolekey }}">{{ Str::title($roleValue) }}</option>
                    @endforeach
                </x-select>

                <x-select label="Assign To" name="assignTo" wire:model="assignTo">
                    <option value="" selected>--Select--</option>
                    @foreach ($this->users as $userkey => $userValue)
                        <option value="{{ $userkey }}">{{ Str::title($userValue) }}</option>
                    @endforeach
                </x-select>

                <x-input type="date" label="Due Date" name="dueDate" wire:model.defer="dueDate" />

                <x-textarea-simple label="Remarks (if any)" name="remarks" wire:model.defer="remarks" optional />

                <x-button with-spinner wire:target="save">Save</x-button>
            </form>
        </div>
    </x-slideovers>
</div>
