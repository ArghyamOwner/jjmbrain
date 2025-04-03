<div>
    <x-card form-action="save">
        <x-card-form class="shadow-none" no-padding>
            <x-slot name="title">Edit Page</x-slot>
           
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

            <x-component-listbox
                optional
                multiple
                label="Extra Content" 
                name="extraContent"
                wire:model="extraContent"
                :options="$this->globalComponents"
            >
                <x-slot name="custom">
                    <template x-if="Object.keys(options).length > 0">
                        <div class="px-4 py-2 hover:bg-slate-100 rounded-lg hover:text-indigo-600">
                            <div class="text-slate-700 font-medium" x-text="option.label"></div>
                            <div class="text-sm text-slate-500" x-text="option?.description"></div>
                        </div>
                    </template>
                </x-slot>
            </x-component-listbox>
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
</div>