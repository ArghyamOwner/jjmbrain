<div>
    <x-slot name="title">Workorder Progress</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders.show', $workorderId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Workorder Progress for {{ $workorderNumber }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($workorderTasks)
            @foreach($workorderTasks as $schemeName => $tasks)
                <div class="mb-8">
                    <x-heading size="md" class="mb-2">Task Progress For: {{ $schemeName }}</x-heading>
                    <div class="bg-white border shadow-sm rounded-lg divide-y">
                        @if ($tasks->isNotEmpty())
                        @foreach($tasks as $workorderTask)
                            <div class="py-3 px-4">
                                <div class="grid grid-cols-1 md:grid-cols-6 gap-x-6">
                                    <div class="md:col-span-5 flex items-center">
                                        <div
                                            class="mr-4"
                                            x-data="{
                                                circumference: 30 * 2 * Math.PI,
                                                percent: {{ intval($workorderTask->progress) }}
                                            }"
                                        >
                                            <template x-if="percent != 100">
                                                <div class="relative inline-flex items-center justify-center overflow-hidden rounded-full shrink-0">
                                                    <span class="absolute text-lg text-blue-700" x-text="`${percent}%`"></span>
                                                    <svg class="w-20 h-20 -rotate-90">
                                                        <circle
                                                            class="text-gray-300"
                                                            stroke-width="5"
                                                            stroke="currentColor"
                                                            fill="transparent"
                                                            r="30"
                                                            cx="40"
                                                            cy="40"
                                                        />
                                                        <circle
                                                            class="text-blue-600"
                                                            stroke-width="5"
                                                            :stroke-dasharray="circumference"
                                                            :stroke-dashoffset="circumference - percent / 100 * circumference"
                                                            stroke-linecap="round"
                                                            stroke="currentColor"
                                                            fill="transparent"
                                                            r="30"
                                                            cx="40"
                                                            cy="40"
                                                        />
                                                    </svg>
                                                </div>
                                            </template>

                                            <template x-if="percent == 100">
                                                <div class="relative inline-flex items-center justify-center overflow-hidden rounded-full shrink-0">
                                                    <span class="absolute text-lg text-green-700" x-text="`${percent}%`"></span>
                                                    <svg class="w-20 h-20 -rotate-90">
                                                        <circle
                                                            class="text-gray-300"
                                                            stroke-width="5"
                                                            stroke="currentColor"
                                                            fill="transparent"
                                                            r="30"
                                                            cx="40"
                                                            cy="40"
                                                        />
                                                        <circle
                                                            class="text-green-600"
                                                            stroke-width="5"
                                                            :stroke-dasharray="circumference"
                                                            :stroke-dashoffset="circumference - percent / 100 * circumference"
                                                            stroke-linecap="round"
                                                            stroke="currentColor"
                                                            fill="transparent"
                                                            r="30"
                                                            cx="40"
                                                            cy="40"
                                                        />
                                                    </svg>
                                                </div>
                                            </template>
                                        </div>
                                        <div>
                                            <x-badge variant="{{ $workorderTask->status->color() }}">{{ $workorderTask->status }}</x-badge>
                                            <p class="py-1 text-slate-800 text-lg font-medium">{{ $workorderTask->task?->task_name }}</p>
                                            <p class="text-slate-500 text-sm">{{ $workorderTask->completed_assignment_subtasks_count }}/{{ $workorderTask->assignment_subtasks_count}} subtask completed</p>
                                        </div>
                                    </div>
        
                                    <div class="flex flex-row md:flex-col md:space-y-2">
                                        <x-button tag="a" href="{{ $workorderTask->task?->task_doc_url }}">Read Instruction</x-button>
                                        <x-button tag="a" href="{{ route('assignmenttasks.show', $workorderTask->id) }}" color="white">View details</x-button> 
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <x-card-empty />
        @endif

        {{-- <x-heading size="md" class="mb-2">Details of Work</x-heading>
        @if (count($workorderSubtasks))
            <div class="space-y-4">
                @foreach($workorderSubtasks as $workorderSubtask)
                    <x-card>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="md:col-span-3">
                                <div class="mb-4">
                                    <p class="mb-1">Task: <span>{{ $workorderSubtask->assignmentTask->task->task_name }}</span></p>
                                    <p class="mb-1">Subtask: <span>{{ $workorderSubtask->subtask->subtask_name }}</span></p>
                                    <p>Submitted By: <span>{{ $workorderSubtask->workorder->contractor->name }}</span></p>
                                </div>
                                
                                <p>{{ $workorderSubtask->remarks }}</p>
                                
                                @if ($workorderSubtask->assignmentImages->isNotEmpty())
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-6">
                                        @foreach($workorderSubtask->assignmentImages as $workorderSubtask->assignmentImage)
                                            <div class="rounded-lg bg-slate-100 overflow-hidden text-center">
                                                <x-lightbox>
                                                    <x-lightbox.item image-url="{{ $workorderSubtask->assignmentImage->image_url }}">
                                                        <img src="{{ $workorderSubtask->assignmentImage->image_url }}" alt="{{ $workorderSubtask->subtask->subtask_name }}" loading="lazy" class="h-32 mx-auto object-fit">
                                                    </x-lightbox.item>
                                                </x-lightbox>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if ($workorderSubtask->completed_at)
                                    Date: {{ $workorderSubtask->completed_at?->format('d/m/Y h:i A') }}
                                @endif
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @else
            <x-card-empty />
        @endif --}}
    </x-section-centered>
</div>
