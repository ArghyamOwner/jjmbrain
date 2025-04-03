<div>
    <div class="bg-white rounded shadow">
        <div class="px-4 py-2 border-b border-gray-200">
            <div class="grid grid-cols-2">
                <div>
                    <x-heading size="lg">Assigned Task</x-heading>
                </div>

                @if ($this->grievanceStatus)
                    <div class="text-right">
                        <x-button color="cyan" tag="a" href="#" x-data class="w-30"
                            x-on:click.prevent="Livewire.emit('addAssignGrievanceTaskSlideover', '{{ $grievance }}')"
                            x-cloak>
                            Assign Task
                        </x-button>
                    </div>
                @endif
            </div>
        </div>
        @if ($tasks->isNotEmpty())
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>Assigned To / Role</x-table.thead>
                        <x-table.thead>Assigned By</x-table.thead>
                        <x-table.thead>Due Date</x-table.thead>
                        <x-table.thead>Remarks</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <x-table.tdata>
                                {{ $task->assignedTo?->name }}
                                <p>
                                    <x-badge>{{ $task->role }}</x-badge>
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $task->assignedBy?->name ?? 'BOT' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $task->due_date ? $task->due_date->format('d-m-Y') : 'NA' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $task->remarks ?? '-' }}
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        @else
            <x-card-empty variant="" class="rounded">
                <p class="text-center text-slate-500 mb-3 text-sm">You cannot assign Task because the status of the
                    scheme has not been updated.</p>
            </x-card-empty>
        @endif
    </div>

    <livewire:assign-grievance-tasks.create />
</div>
