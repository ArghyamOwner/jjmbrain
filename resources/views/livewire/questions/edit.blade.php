<div>
    <x-slot name="title">Edit Question</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('campaigns.show', $campaignId) }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>Edit Question</x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card form-action="save">
                <x-textarea-simple label="Question" name="question" wire:model.defer="question" />

                {{-- <div class="mb-5">
            <x-label for="logo" class="mb-1" optional>Image</x-label>
            <x-text-hint class="mb-1">Maximum file size: 2 MB. Allowed file types: JPG, PNG</x-text-hint>
            
            @if ($imageUrl)
                <div class="mb-4 p-2 rounded-lg border bg-slate-50 overflow-hidden w-1/2">
                    <img src="{{ $imageUrl }}" alt="question-image" loading="lazy" class="object-contain rounded-lg h-48 mx-auto" />
                </div>
            @endif

            <x-filepond
                name="image"
                wire:model.defer="image"
            />
        </div> --}}

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

                <x-slot name="footer" class="text-right">
                    <x-button type="submit" with-spinner wire:target="save">Update</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
