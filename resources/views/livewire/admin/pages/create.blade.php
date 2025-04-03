<div>
    <x-slot name="title">New Page</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('admin.pages') }}">Back to pages</x-text-link>
            </x-slot>

            <x-slot:title>
                New Page
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form class="shadow-none" no-padding>
                <x-slot name="title">Create Page</x-slot>
            
                <x-input
                    label="Page Title" 
                    name="title"
                    wire:model.defer="title"
                />

                <x-textarea-constrained
                    label="Summary"
                    wire:model.defer="summary"
                    name="summary"
                    rows="3"
                    maxlength="150"
                />
                
                <x-quilljs-editor
                    label="Content" 
                    name="content"
                    :initial-value="$content"
                    wire:model.defer="content"
                />

                <x-heading size="md" class="mb-2">Page Status</x-heading>
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
            </x-card-form>
            
            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button
                    color="black"
                    with-spinner
                    wire:target="save"
                >Save Page</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>