<div>
    <x-slot name="title">Create Review Questions</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reviewsections.show', $reviewsectionId) }}">Go Back</x-text-link>
            </x-slot>
            
            <x-slot:title>
                Create Review Questions
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save" card-classes="mb-6">
            <x-input label="Question" name="question" wire:model.defer="question" />
            {{-- <div class="md:w-64">
                <x-input-number label="Question Marks" name="marks" wire:model.defer="marks" />
            </div> --}}

            <x-label class="mb-1">Options</x-label>
            <x-input-error for="questionOptions" />

            <div wire:sortable="updateOptionOrder" class="space-y-2">
                @if (count($questionOptions))
                    {{-- <div class="divide-y border rounded-lg shadow-sm"> --}}
                        @foreach($questionOptions as $questionOptionIndex => $questionOption)
                            <div class="border rounded-lg shadow-sm p-2 flex items-center" wire:key="group-{{ $questionOptionIndex + 1 }}" wire:sortable.item="{{ $questionOption['value'] }}">
                                <div wire:sortable.handle class="cursor-move flex items-center space-x-2">
                                    <x-iconic-dots class="w-5 h-5 text-gray-500" />
                                </div>
                                <div class="flex-1 px-3">
                                    {{ $questionOption['value'] }} ({{ $questionOption['marks'] }})
                                </div>
                                <div class="w-10">
                                    <x-button-icon-delete wire:click="removeOption('{{ $questionOption['value'] }}')" />
                                </div>
                            </div>
                        @endforeach
                    {{-- </div> --}}
                @else
                    <div class="text-xs text-slate-400">No options added yet.</div>
                @endif
            </div>
            
            <x-text-link href="#" class="flex items-center mt-4 text-sm" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'question-option-modal')"><x-icon-add class="w-5 h-5 mr-1" />Add Options</x-text-link>
        
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

    </x-section-centered>


    <x-modal-simple name="question-option-modal" form-action="addOption">
        <x-slot:title>
            Add an option to question
        </x-slot>

        <x-input label="Option Details" name="option" wire:model.defer="option" />

        <x-input-number label="Option Marks" name="marks" wire:model.defer="marks" />

        <x-slot:footer>
            <x-button type="submit" wire:target="addOption" with-spinner>Add Option</x-button>
        </x-slot>
    </x-modal-simple>

    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.min.js"></script>
    @endpush
</div>
