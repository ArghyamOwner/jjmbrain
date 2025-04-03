<div>
    <x-slot name="title">Edit Article</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('articles') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Article
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-select label="Category" name="category" wire:model.defer="category">
                <option value="">Select a category</option>
                @foreach ($this->categories as $categoryKey => $categoryValue)
                    <option value="{{ $categoryKey }}">{{ $categoryValue }}</option>
                @endforeach
            </x-select>

            <x-input label="Title" name="title" wire:model.defer="title" />
            
            <x-tinymce-editor label="Content" name="content" wire:model.defer="content" />

            <x-heading size="md" class="mb-2">Article Status</x-heading>
            <x-radio-group
                name="role"
                wire:model.defer="status"
                default-value="visible"
                :options="[
                    [
                        'label' => 'Visible',
                        'value' => 'visible',
                        'summary' => 'Will be visible for browsing.'
                    ],
                    [
                        'label' => 'Hidden',
                        'value' => 'hidden',
                        'summary' => 'Will not be visible for browsing.'
                    ]
                ]"
            />
            
            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
