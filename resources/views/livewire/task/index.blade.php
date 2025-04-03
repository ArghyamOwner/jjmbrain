<div>
    <x-slot name="title">All Tasks</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Tasks
    </x-slot>

    <x-slot name="action">
        <x-button tag="a" href="{{ route('tasks.create') }}" with-icon icon="add">New task</x-button>
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($tasks->isNotEmpty() || ($tasks->isEmpty() && $search))
                <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="md:col-span-2">
                        <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                            placeholder="Search..." />
                    </div>
                </div>
            @endif

            @if ($tasks->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Category</x-table.thead>
                                <x-table.thead>Activity</x-table.thead>
                                <x-table.thead>Task Name</x-table.thead>
                                <x-table.thead>No. of subtasks</x-table.thead>
                                <x-table.thead>Total Assigned</x-table.thead>
                                {{-- <x-table.thead>Active</x-table.thead>
                                <x-table.thead>Avg. time to complete</x-table.thead> --}}
                                <x-table.thead>Estimated time (hours)</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <x-table.tdata>
                                        <x-badge variant="{{ $task->category->color() }}">{{ $task->category->name }}
                                        </x-badge>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $task?->activity?->name ?? '-' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $task->task_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $task->subtasks_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $task->assignment_task_count }}
                                    </x-table.tdata>
                                    {{-- <x-table.tdata>
                                        0
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        0
                                    </x-table.tdata> --}}
                                    <x-table.tdata>
                                        {{ $task->task_estimated_time ?? 0 }}
                                    </x-table.tdata>

                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-show href="{{ route('tasks.show', $task->id) }}" />
                                            <x-button-icon-edit href="{{ route('tasks.edit', $task->id) }}" />
                                            {{-- <x-button-icon-delete 
                                                href="#" 
                                                x-data=""
                                                x-cloak
                                                x-on:click.prevent="$wire.emitTo(
                                                    'tasks.delete',
                                                    'showDeleteModal',
                                                    '{{ $tasksFeed->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this tasks details?',
                                                    '{{ $tasksFeed->title }}'
                                                )"
                                            /> --}}
                                        </div>
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($tasks->hasPages())
            <div class="mt-5">{{ $tasks->links() }}</div>
        @endif
    </x-section-centered>
</div>
