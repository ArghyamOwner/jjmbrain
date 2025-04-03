<div>
    <x-slot name="title">Update WUC Documents</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('wucs.show', $wuc->id) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Update WUC Documents
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-4">
            <x-alert variant="error" :close="false">
                Kindly be informed that all existing documents will remain intact within the records following the update of a new document, ensuring continuity and preservation of data.
            </x-alert>
        </div>
        <x-card overflow-hidden form-action="update"> 
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-filepond accept-files="application/pdf" label="Upload WUC Approval document"
                    name="approval_document" wire:model.defer="approval_document" />
                <x-filepond optional accept-files="application/pdf" label="Upload Constitution document"
                    name="constitution_document" wire:model.defer="constitution_document" />
            </div>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="update">Update</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>