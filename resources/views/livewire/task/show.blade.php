<div>
    <x-slot name="title">Task Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tasks') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Task Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <x-card>
                    <x-description-list size="xs">
                        <x-description-list.item>
                            <x-slot name="title">Category</x-slot>
                            <x-slot name="description">
                                <x-badge variant="{{ $task->category->color() }}">{{ $task->category }}</x-badge>
                            </x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Task Name</x-slot>
                            <x-slot name="description">{{ $task->task_name }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Task ID</x-slot>
                            <x-slot name="description">{{ $task->task_uin }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Activity</x-slot>
                            <x-slot name="description">{{ $task?->activity?->name ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Estimated Time (hours)</x-slot>
                            <x-slot name="description">{{ $task->task_estimated_time }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Description</x-slot>
                            <x-slot name="description">{{ $task->task_description }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>
                </x-card>

                <x-card>
                    <x-heading size="md" class="mb-2">Quick Actions</x-heading>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        <x-button tag="a" href="{{ route('subtasks.create', $task->id) }}" color="white" with-icon
                            icon="add">Add subtask</x-button>
                        <x-button tag="a" href="#" color="white" with-icon icon="eye">View progress</x-button>
                        <x-button tag="a" target="_blank" href="{{ $task->task_doc_url }}" color="white" with-icon
                            icon="download">Instruction Doc</x-button>
                        <x-button tag="a" href="#" color="white" class="h-10"></x-button>
                        <x-button tag="a" href="#" color="white" class="h-10"></x-button>
                        <x-button tag="a" href="#" color="white" class="h-10"></x-button>
                        <x-button tag="a" href="#" color="white" class="h-10"></x-button>
                        <x-button tag="a" href="#" color="white" class="h-10"></x-button>
                        <x-button tag="a" href="#" color="white" with-icon icon="trash" class="text-red-600" x-data=""
                            x-cloak x-on:click.prevent="$wire.emitTo(
                            'task.delete',
                            'showDeleteModal',
                            '{{ $task->id }}',
                            'Confirm Deletion',
                            'Are you sure you want to remove this task & its associated subtasks details?',
                            '{{ $task->task_name }}'
                        )">Delete task</x-button>
                    </div>
                </x-card>
            </div>

            <div class="mb-5">
                <x-heading size="lg" class="mb-2">Details of Subtasks</x-heading>
                @if($task->subtasks->isNotEmpty())
                <x-card no-padding overflow-hidden>
                    <x-table.table :rounded="false" :with-shadow="false">
                        <thead>
                            <tr>
                                <x-table.thead>Subtask Name</x-table.thead>
                                <x-table.thead>Type</x-table.thead>
                                <x-table.thead>Estimated time (hours)</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task->subtasks as $subtask)
                            <tr>
                                <x-table.tdata>
                                    {{ $subtask->subtask_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $subtask->type }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $subtask->subtask_estimated_time }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="{{ route('subtasks.edit', $subtask->id) }}" />
                                        <x-button-icon-add href="{{ route('subtasks.reviewQuestions', $subtask->id) }}"
                                            tooltip-title="Add Review Questions" />
                                        {{--
                                        <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'tasks.delete',
                                                    'showDeleteModal',
                                                    '{{ $tasksFeed->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this tasks details?',
                                                    '{{ $tasksFeed->title }}'
                                                )" /> --}}
                                    </div>
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </x-card>
                @else
                <x-card-empty>
                    No subtasks added yet.
                </x-card-empty>
                @endif
            </div>

            <x-heading size="lg" class="mb-2">Assigned Task Details</x-heading>
            @if($task->assignmentTask->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-table.table :rounded="false" :with-shadow="false">
                    <thead>
                        <tr>
                            <x-table.thead>Scheme Name</x-table.thead>
                            <x-table.thead>Scheme Division</x-table.thead>
                            <x-table.thead>Workorder No</x-table.thead>
                            <x-table.thead>Task Status</x-table.thead>
                            <x-table.thead>Assigned By</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($task->assignmentTask as $taskDetail)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('schemes.show', $taskDetail->scheme_id) }}">
                                    {{ $taskDetail?->scheme?->name }}
                                </x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $taskDetail?->scheme?->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-text-link href="{{ route('workorders.show',$taskDetail->workorder_id) }}">
                                    {{ $taskDetail?->workorder?->workorder_number }}
                                </x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-badge variant="{{ $taskDetail->status->color() }}">{{ $taskDetail->status }}
                                </x-badge>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $taskDetail?->user?->name }}
                                <p class="text-sm">{{ $taskDetail?->user?->phone }}</p>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>
            @else
            <x-card-empty>
                Task Not Assgned Yet.
            </x-card-empty>
            @endif

            <livewire:task.delete />
        </x-section-centered>
</div>