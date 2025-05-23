<div>
    <x-slot name="title">Edit Subtask</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tasks.show', $taskId) }}">Go back to task</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Subtask
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Edit subtask</x-slot>

                <x-radio-pill
                    label="Select subtask type"
                    name="subtask_type"
                    wire:model="subtask_type"
                    :default-value="$subtask_type"
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
                
                <x-input label="Name of subtask" name="subtask_name" wire:model.defer="subtask_name" />
                
                <x-input-number label="Estimated time in days" name="subtask_estimated_time" wire:model.defer="subtask_estimated_time" />

                <x-textarea-simple optional label="Brief description of the subtask" name="subtask_description" wire:model.defer="subtask_description" />

                <div class="mb-5">
                    <label for="showForm" class="inline-flex mb-1">
                        <input id="showForm" type="checkbox" name="showForm"
                            class="mt-1 mr-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring-1 focus:ring-indigo-200 focus:ring-opacity-50 w-5 h-5"
                            wire:model.defer="showForm">
                        <div class="ml-2 select-none text-slate-600">
                            <x-label class="mb-1">Show Review Form</x-label>
                            <p class="text-sm text-slate-500">Enable/Disable the form for the TPA review in the mobile app</p>
                        </div>
                    </label>
                </div>

                <div>
                    @if($subtask_type === 'choice') 
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