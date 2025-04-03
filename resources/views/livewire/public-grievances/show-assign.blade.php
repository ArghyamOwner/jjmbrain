<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Grievance Application Details</x-slot>
        <div class="py-3 px-6">
            @if ($tasks->isNotEmpty())
                @foreach ($tasks as $key => $task)
                    <x-timeline :last="$loop->last">
                        <x-slot name="title">{{ $task->assignedTo?->name }},
                            {{ $task->assignedTo?->designation }}</x-slot>
                        <x-slot name="subtitle">Assigned on {{ $task->created_at->format('d-M-Y') }}</x-slot>
                    </x-timeline>
                @endforeach
            @endif
        </div>
    </x-slideovers>
</div>
