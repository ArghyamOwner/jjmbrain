<div>
    <x-section-heading>
        <x-slot:title>
            Questions
            </x-slot>

            <x-slot name="action">
                @if ($questionsCount !== $numberOfQuestions)
                    <x-button tag="a" href="#" with-icon icon="add" x-data="{}"
                        x-on:click.prevent="$dispatch('show-modal', 'question-create-form')" x-cloak>New Question
                    </x-button>
                @endif
            </x-slot>
    </x-section-heading>

    @if ($questions->isNotEmpty())
        <div class="space-y-2">
            @foreach ($questions as $questionIndex => $question)
                <div x-data="{ activeAccordion: false }" class="group bg-white rounded-lg shadow p-4" x-cloak>
                    <div class="flex items-center">
                        <div class="flex-1">
                            <button type="button" @click="activeAccordion = !activeAccordion"
                                :aria-expanded="activeAccordion" aria-controls="accordion-panel-{{ $questionIndex }}"
                                class="button group-aria-expanded:button-active">
                                <x-heading size="md" class="hover:text-indigo-600">{{ $question->question }}
                                </x-heading>
                            </button>
                        </div>
                        <div>
                            <div class="flex space-x-1">
                                <x-button-icon-edit href="{{ route('questions.edit', $question->id) }}" />
                            </div>
                        </div>
                    </div>

                    <section :hidden="!activeAccordion" id="accordion-panel-{{ $questionIndex }}"
                        aria-labelledby="accordion-header-{{ $questionIndex }}">
                        <div class="content pt-2">
                            @if ($question->image)
                                <div class="mb-4 p-2 rounded-lg border bg-slate-50 overflow-hidden w-1/2">
                                    <img src="{{ $question->image_url }}" alt="question-image" loading="lazy"
                                        class="object-contain rounded-lg h-48 mx-auto" />
                                </div>
                            @endif

                            <p class="mb-2 text-slate-400 uppercase text-xs font-medium tracking-wider">Answers</p>
                            <div class="flex space-x-2 items-center">
                                <div
                                    class="shrink-0 w-4 h-4 rounded-full {{ $question->correct_answer === 'option_1' ? 'bg-green-600' : 'bg-slate-200' }}">
                                </div>
                                <div>
                                    {{ $question->option_1 }}
                                </div>
                            </div>
                            <div class="flex space-x-2 items-center">
                                <div
                                    class="shrink-0 w-4 h-4 rounded-full {{ $question->correct_answer === 'option_2' ? 'bg-green-600' : 'bg-slate-200' }}">
                                </div>
                                <div>
                                    {{ $question->option_2 }}
                                </div>
                            </div>

                            @if ($question->option_3)
                                <div class="flex space-x-2 items-center">
                                    <div
                                        class="shrink-0 w-4 h-4 rounded-full {{ $question->correct_answer === 'option_3' ? 'bg-green-600' : 'bg-slate-200' }}">
                                    </div>
                                    <div>
                                        {{ $question->option_3 }}
                                    </div>
                                </div>
                            @endif

                            @if ($question->option_4)
                                <div class="flex space-x-2 items-center">
                                    <div
                                        class="shrink-0 w-4 h-4 rounded-full {{ $question->correct_answer === 'option_4' ? 'bg-green-600' : 'bg-slate-200' }}">
                                    </div>
                                    <div>
                                        {{ $question->option_4 }}
                                    </div>
                                </div>
                            @endif

                            {{-- <div class="mt-2 text-sm text-slate-600">{{ $question->marks }} marks</div> --}}
                        </div>
                    </section>
                </div>
            @endforeach
        </div>
    @else
        <x-card card-classes="text-center py-6">
            <p class="text-slate-500 mb-2">No questions added yet.
        </x-card>
    @endif

    <x-modal-simple max-width="lg" name="question-create-form" form-action="save">
        <x-slot name="title">Create a Question</x-slot>

        <x-textarea-simple label="Question" name="question" wire:model.defer="question" />

        {{-- <x-filepond
            optional
            label="Image"
            hint="Maximum file size: 2 MB. Allowed file types: JPG, PNG"
            name="image"
            wire:model.defer="image"
        /> --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input label="Option 1" name="option_1" wire:model.defer="option_1" />
            <x-input label="Option 2" name="option_2" wire:model.defer="option_2" />
            <x-input optional label="Option 3" name="option_3" wire:model.defer="option_3" />
            <x-input optional label="Option 4" name="option_4" wire:model.defer="option_4" />
        </div>

        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-select label="Correct Answer" name="correct_answer" wire:model.defer="correct_answer">
                <option value="">--Select correct answer--</option>
                <option value="option_1">Option 1</option>
                <option value="option_2">Option 2</option>
                <option value="option_3">Option 3</option>
                <option value="option_4">Option 4</option>
            </x-select>
    
            <x-input-number label="Marks" name="marks" wire:model.defer="marks" />
        </div> --}}

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-modal-simple>
</div>
