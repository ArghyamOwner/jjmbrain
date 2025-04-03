<div>
    <x-slot name="title">Add task to workorder</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders.show', $workorderId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Add task to workorder
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <x-select label="Select scheme" name="scheme" wire:model.defer="scheme" no-margin>
                    <option value="">--Select a scheme--</option>
                    @foreach ($schemes as $schemeObject)
                        <option value="{{ $schemeObject->id }}">{{ $schemeObject->name }}</option>
                    @endforeach
                </x-select>

                <x-select label="Select Activity" name="activity_id" wire:model="activity_id" no-margin>
                    <option value="">--Select an Activity--</option>
                    @foreach ($this->activities as $activityKey => $activityValue)
                        <option value="{{ $activityKey }}">{{ $activityValue }}</option>
                    @endforeach
                </x-select>

                {{-- <x-select label="Assign Task" name="task" wire:model="task" no-margin>
                    <option value="">--Select a task--</option>
                    @foreach ($this->tasks as $taskObject)
                        <option value="{{ $taskObject->id }}">{{ $taskObject->task_name }}</option>
                    @endforeach
                </x-select> --}}

                <x-virtual-select 
                    no-margin
                    label="Assign Task" 
                    name="task" 
                    wire:model.defer="task" 
                    :options="[
                        'selectAllOnlyVisible' => true,
                        'options' => $tasks,
                        'multiple' => true,
                        'showValueAsTags' => true,
                    ]"
                />

                <div>
                    <x-label class="mb-1">&nbsp;</x-label>
                    <x-button
                        type="button"
                        onclick="confirm('Are you sure you want to Assign this task to Workorder?') || event.stopImmediatePropagation()"
                        wire:click="save" 
                        with-spinner>Assign Task</x-button>
                </div>
            </div>
        </x-card>

        {{-- @if ($assignedTasks->isNotEmpty())
        <x-heading size="md" class="mb-2">Task and subtasks assigned to a workorder</x-heading>
        <x-card overflow-hidden no-padding>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Task Name</x-table.thead>
                        <x-table.thead>Estimated Time</x-table.thead>
                        <x-table.thead>Subtasks</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignedTasks as $assignedTask)
                        <tr>
                            <x-table.tdata>
                                {{ $assignedTask->task->task_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $assignedTask->task->task_estimated_time }} days
                            </x-table.tdata>

                            <x-table.tdata>
                                @if ($assignedTask->assignmentSubtasks->isNotEmpty())
                                    <ol class="list-decimal ml-4">
                                        @foreach ($assignedTask->assignmentSubtasks as $assignmentSubtask)
                                            <li>
                                                {{ $assignmentSubtask->subtask->subtask_name }}
                                            </li>
                                        @endforeach
                                    </ol>
                                @else
                                    No subtasks available.
                                @endif
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </x-card>
    @else
        <x-card-empty>No tasks assigned to workorder.</x-card-empty>
    @endif --}}

        @if ($assignedTasks->isNotEmpty())
            <x-heading size="md" class="mb-2">Task and subtasks assigned to schemes under a workorder
            </x-heading>
            @foreach ($assignedTasks as $schemeName => $tasks)
                <x-card overflow-hidden no-padding card-classes="mb-6">
                    <div class="font-semibold text-slate-800 py-2 px-3 border-b">
                        Scheme: {{ $schemeName }}
                    </div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Task Name</x-table.thead>
                                <x-table.thead>Estimated Time</x-table.thead>
                                <x-table.thead>Subtasks</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $assignedTask)
                                <tr>
                                    <x-table.tdata>
                                        {{ $assignedTask?->task?->task_name ?? '-'}}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $assignedTask?->task?->task_estimated_time ?? '-'}} days
                                    </x-table.tdata>

                                    <x-table.tdata>
                                        @if ($assignedTask->assignmentSubtasks->isNotEmpty())
                                            <ol class="list-decimal ml-4">
                                                @foreach ($assignedTask->assignmentSubtasks as $assignmentSubtask)
                                                    <li>
                                                        {{ $assignmentSubtask?->subtask?->subtask_name ?? '-' }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @else
                                            No subtasks available.
                                        @endif
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </x-card>
            @endforeach
        @else
            <x-card-empty>No tasks assigned to workorder.</x-card-empty>
        @endif
    </x-section-centered>
</div>
