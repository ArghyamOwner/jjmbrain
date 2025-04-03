<div>
    <x-slot name="title">Subtask Review Questions</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('subtasks.reviewQuestions', $subtaskId) }}">Go back</x-text-link>
            </x-slot>

            <x-slot:title>
                Subtask Review Questions
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Create a new review question</x-slot>
              
                    <x-radio-pill
                        label="Select question type"
                        name="question_type"
                        wire:model="question_type"
                        default-value="text"
                        :options="[
                            [
                                'label' => 'Text',
                                'value' => 'text',
                            ],
                            [
                                'label' => 'Date',
                                'value' => 'date',
                            ],
                            [
                                'label' => 'Choice',
                                'value' => 'choice',
                            ]
                        ]"
                    />
                    
                    <x-input label="Question Title" name="question" wire:model.defer="question" />
                    
                    <x-textarea-simple optional label="Brief description of the question" name="description" wire:model.defer="description" />
    
                    <div>
                        @if($question_type === 'choice') 
                            <x-label class="mb-1">Options/Choices</x-label>  
                            <x-input-error for="choices" />

                            <div class="border rounded-lg my-2">
                                @if ($choices)
                                    <div class="divide-y">
                                        @foreach($choices as $choice)
                                            <div class="px-4 py-2 flex items-center">
                                                <div class="flex-1 truncate">{{ $choice }}</div>
                                                <div>
                                                    <x-button-icon-delete
                                                        wire:click.prevent="removeChoice('{{ $choice}}')"
                                                    />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-sm p-4">No choices added.</div>
                                @endif
                            </div>
                            
                            <x-text-link href="#" x-data x-on:click.prevent="$dispatch('show-modal', 'addChoiceForm')"><x-icon-add class="w-5 h-5 mr-1" />Add choice</x-text-link>
                        @endif
                    </div>
                </div>
            </x-card-form>
           
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
        
        <x-modal-simple max-width="xl" name="addChoiceForm" form-action="addChoice">
            <x-slot:title>Add Choice</x-slot>
    
            <x-input label="Choice Details" name="choiceDetails" wire:model.defer="choiceDetails" />
    
            <x-slot:footer>
                <x-button type="submit" with-spinner wire:target="addChoice">Save</x-button>
            </x-slot>
        </x-modal-simple>
    </x-section-centered>
</div>