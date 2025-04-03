<div>
    <x-banner class="mb-5" />
    @if ($schemeReviewCompleted)
        <div class="shadow rounded-lg ring-1 ring-slate-200 p-6 md:p-10">
            <div class="w-20 mx-auto mb-5">
                <svg class="w-20 h-20 fill-current text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706z"></path></svg>
            </div>

            <div class="text-center">
                <p class="mb-10">You have reviewed <br>
                    <strong>{{ $reviewSectionTitle }}</strong> <br>
                    of <br>
                    <strong>{{ $schemeName }}</strong></p>

                <x-button tag="a" href="/schemes/{{ $schemeId }}/qrcode-scan#seven" class="w-64 py-3">More review</x-button>
            </div>
        </div>
    @else 
        @if ($questions->isNotEmpty())
            @error('answers')
                <x-alert variant="error" class="mt-2 mb-4">{{ $message }}</x-alert>    
            @enderror

            <x-card card-classes="mb-5" form-action="save">                
                @foreach($questions as $questionIndex => $question)
                    <div class="mb-10">
                        <x-heading size="md" class="mb-2">Q: {{ $question->question }}</x-heading>

                        @if ($question->options->isNotEmpty())
                            @foreach($question->options as $option)
                                <div class="py-1">
                                    <x-radio 
                                        id="{{ $question->id }}{{ $option->id }}"
                                        label="{{ $option->option }}"
                                        name="answers.{{ $questionIndex }}.selected_option" 
                                        wire:model.defer="answers.{{ $questionIndex }}.selected_option"
                                        value="{{ $question->id }}|{{ $option->id }}"
                                    />
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach

                <x-textarea-simple
                    optional
                    label="Remark/Comment"
                    name="remark"
                    wire:model.defer="remark"
                />

                <x-filepond
                    optional
                    label="Photo"
                    name="photo"
                    wire:model.defer="photo"
                    hint="JPEG,PNG files allowed"
                />

                <x-slot:footer>
                    <x-button with-spinner wire:target="save,photo" class="w-full">Submit review</x-button>
                </x-slot>
            </x-card>
        @endif
    @endif
</div>
