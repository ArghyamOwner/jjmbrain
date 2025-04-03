<div>
    <x-slot name="title">Subtask Review Questions</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tasks.show', $taskId) }}">Go back to tasks</x-text-link>
            </x-slot>

            <x-slot:title>
                Subtask Review Questions
            </x-slot>

            <x-slot:action>
                <x-button tag="a" href="{{ route('subtasks.reviewQuestionsCreate', $subtaskId) }}" with-icon icon="add" with-spinner>Add Question</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if($reviewQuestions->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-table.table :rounded="false" :with-shadow="false">
                    <thead>
                        <tr>
                            <x-table.thead>Question</x-table.thead>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviewQuestions as $reviewQuestion)
                            <tr>
                                <x-table.tdata>
                                    {{ $reviewQuestion->question }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $reviewQuestion->type }}

                                    @if ($reviewQuestion->type == 'choice')
                                        ({{ collect($reviewQuestion->options)->join(', ') }})
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-delete
                                            x-on:click.prevent="$wire.emitTo(
                                                'subtask.review-question-delete',
                                                'showDeleteModal',
                                                '{{ $reviewQuestion->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this question?',
                                                '{{ $reviewQuestion->question }}'
                                            )"
                                        />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <livewire:subtask.review-question-delete />
        @else
            <x-card-empty>
                No review questions added yet.
            </x-card-empty>
        @endif
    </x-section-centered>
</div>