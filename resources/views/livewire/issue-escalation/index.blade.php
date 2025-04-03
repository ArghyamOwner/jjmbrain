<div>
    <x-section-heading>
        <x-slot:title>
            Escalation Matrix
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="#" with-icon icon="add" x-data="{}"
                    x-on:click.prevent="$dispatch('show-modal', 'question-create-form')" x-cloak>Escalation Matrix
                </x-button>
            </x-slot>
    </x-section-heading>

    @if ($escalations->isNotEmpty())
        {{-- <div class="space-y-2">
            @foreach ($escalations as $questionIndex => $question)
                <div x-data="{ activeAccordion: false }" class="group bg-white rounded-lg shadow p-4" x-cloak>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <button type="button" class="button group-aria-expanded:button-active">
                                <x-heading size="md" class="hover:text-indigo-600">{{ $question->role }}
                                </x-heading>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <x-alertbox variant="error" class="mb-3"><strong>Note:</strong> You can drag n drop the order of the Escalation
            Matrix.</x-alertbox>

        <div class="space-y-2">
            <ul class="space-y-2 w-1/2" wire:sortable="updateEscalationOrder">
                @foreach ($escalations as $escalation)
                    <li wire:sortable.item="{{ $escalation->id }}" wire:key="escalation-{{ $escalation->id }}">
                        <div x-data="{ activeAccordion: false }" class="group bg-white rounded-lg shadow p-4" x-cloak>
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <h4 wire:sortable.handle> ({{ $escalation->level }}) {{ $escalation->role }}</h4>
                                </div>
                                <div class="flex text-sm">
                                    Day(s) : {{ $escalation->days ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <x-card card-classes="text-center py-6">
            <p class="text-slate-500 mb-2">No escalations added yet.
        </x-card>
    @endif

    <x-modal-simple max-width="lg" name="question-create-form" form-action="save">
        <x-slot name="title">Add an Actor for Escalation Matrix</x-slot>

        <x-select label="Select Actor" name="role" wire:model.defer="role">
            <option value="">--Select Actor--</option>
            @foreach ($this->roles as $roleKey => $roleValue)
                <option value="{{ $roleKey }}">{{ $roleValue }}</option>
            @endforeach
        </x-select>

        <x-input-number 
            maxlength="3" 
            input-mode="numeric" 
            label="No. of days" 
            name="days" 
            wire:model.defer="days"
            placeholder="Enter Average days Required for the Actor to Work on this Issue" 
        />

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
    @once
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/livewire-sortable@0.2.2/dist/livewire-sortable.min.js"></script>
        @endpush
    @endonce
</div>
