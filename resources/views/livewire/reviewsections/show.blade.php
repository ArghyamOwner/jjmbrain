<div>
    <x-slot name="title">Edit Review Section</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reviewsections') }}">Go Back</x-text-link>
            </x-slot>
            
            <x-slot:title>
                Edit Review Section
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save" card-classes="mb-6">
            <x-input label="Title" name="title" wire:model.defer="title" />
            <x-input-number label="User Marks" name="userMarks" wire:model.defer="userMarks" />
            
            <x-radio-pill 
                label="Type"
                name="Type"
                wire:model.defer="type"
                :default-value="$type"
	            :options="[
                    [
                        'label' => 'Administrative',
                        'value' => 'administrative'
                    ],
                    [
                        'label' => 'Technical',
                        'value' => 'technical'
                    ]
                ]"
            />

            <x-label for="logo" class="mb-1" optional>Photo</x-label>
            <x-text-hint class="mb-1">Maximum file size: 4 MB. Allowed file types: JPG, PNG</x-text-hint>
            <div class="flex space-x-4">
                <div class="rounded-lg p-1 w-20 border bg-slate-100 overflow-hidden flex items-center justify-center" style="height: 76px">
                    @if ($photoUrl)
                        <img src="{{ $photoUrl }}" alt="logo" loading="lazy" class="object-fit h-16 rounded-lg w-auto" />
                    @else
                        <x-icon-gallery class="w-12 h-12 mt-4 mx-auto text-slate-200" />
                    @endif
                </div>

                <div class="flex-1">
                    <x-filepond
                        name="photo"
                        wire:model.defer="photo"
                    />
                </div>
            </div>
        
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Update</x-button>
            </x-slot>
        </x-card>
 
        <x-section-heading>
            <x-slot:title>Questions</x-slot>
            <x-slot:action>
                <x-button color="white" tag="a" href="{{ route('reviewsections.questions.create', $reviewsectionId) }}" class="text-sky-600" with-icon icon="add">New Question</x-button>
            </x-slot>
        </x-section-heading>

        <div wire:sortable="updateQuestionOrder">
            @if ($questions->isNotEmpty())
                @foreach($questions as $question)
                    <div class="cursor-move mb-5 bg-white overflow-hidden shadow-sm ring-1 ring-slate-200 rounded-lg"
                        wire:key="question-{{ $question->id }}" 
                        wire:sortable.item="{{ $question->id }}"
                        wire:sortable.handle
                    >
                       <div class="flex items-center px-4 py-2">
                            <div class="flex-1 pr-3">
                                <x-heading size="lg">
                                    Q. {{ $question->question }}
                                </x-heading>
                            </div>
                            <div class="shrink-0">
                                <x-button-icon-delete
                                    x-on:click.prevent="$wire.emitTo(
                                        'reviewsections.questions-delete',
                                        'showDeleteModal',
                                        '{{ $question->id }}',
                                        'Confirm Deletion',
                                        'Are you sure you want to delete the question? This action cannot be undone, and the question will be permanently removed from the database.',
                                        '{{ $question->question }}'
                                    )" 
                                />
                            </div>
                       </div>
    
                        @if ($question->options?->isNotEmpty())
                            <div class="bg-gray-50 border-t border-slate-100 p-4">
                                <ul class="list-decimal list-inside">
                                    @foreach($question->options as $option)
                                        <li>
                                            {{ $option->option}} (<span class="text-slate-500">{{ number_format($option->marks, 1) }}</span>)
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <x-card-empty>
                    No questions added yet.
                </x-card-empty>
            @endif
        </div>
    </x-section-centered>

    <livewire:reviewsections.questions-delete />

    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.min.js"></script>
    @endpush
</div>
