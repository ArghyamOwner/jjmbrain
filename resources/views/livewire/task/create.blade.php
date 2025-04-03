<div>
    <x-slot name="title">Create Task</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tasks') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Create Task
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Create a new task</x-slot>

                <x-select label="Activity" name="activity_id" wire:model.defer="activity_id">
                    <option value="">--Select an Activity--</option>
                    @foreach ($this->activities as $actKey => $actValue)
                        <option value="{{ $actKey }}">{{ $actValue }}</option>
                    @endforeach
                </x-select>

                <x-select label="Category" name="category" wire:model.defer="category">
                    <option value="">--Select a category--</option>
                    @foreach ($this->categories as $taskCategory)
                        <option value="{{ $taskCategory->value }}">{{ $taskCategory->name }}</option>
                    @endforeach
                </x-select>

                <x-input label="Name of task" name="task_name" wire:model.defer="task_name" />

                <x-filepond accept-files="application/pdf" label="Upload instruction document" name="task_doc"
                    wire:model.defer="task_doc" />

                {{-- <x-input-number label="Estimated time in days" name="task_estimated_time" wire:model.defer="task_estimated_time" /> --}}

                <x-textarea-simple optional label="Brief Description of the task" name="task_description"
                    wire:model.defer="task_description" />
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,task_doc">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
