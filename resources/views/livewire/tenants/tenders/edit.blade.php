<div>
    <x-slot name="title">Edit Tender</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tenant.tenders.all') }}">Back to tenders</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Tender
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="save" class="mb-8">
            <x-slot name="title">Edit Tender</x-slot>
            <x-slot name="description">Update details of your published tenders.</x-slot>
 
            <x-textarea
                rows="3"
                label="Tender Name" 
                name="name"
                wire:model.defer="name" 
            />

            <x-input
                label="Tender Number" 
                name="tender_no"
                wire:model.defer="tender_no" 
            />
 
            <x-flatpicker
                label="Tender Due Date" 
                name="due_date"
                wire:model="due_date" 
                :options="[
                    'defaultDate' => null
                ]"
            />
        

            <x-flatpicker
                label="Tender Date" 
                name="publish_date"
                wire:model="publish_date" 
                :options="[
                    'defaultDate' => null
                ]"
            />
            
            <x-slot name="footer">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button
                    color="black"
                    with-spinner
                    wire:target="save"
                >Update Tender</x-button>
            </x-slot>
        </x-card-form>

        <x-card-form form-action="saveTenderDocuments" class="mb-8">
            <x-slot name="title">Edit Tender</x-slot>
            <x-slot name="description">
                <x-button with-icon icon="file" class="mt-2 text-sky-600" color="white" tag="a" href="#" x-data="{}" x-on:click.prevent="$dispatch('show-modal', 'tender-create')">Upload Document</x-button>
            </x-slot>

            @if(count($tenderDocuments))
                <div class="divide-y border rounded-lg">
                    @foreach($tenderDocuments as $tenderDocument)
                        <div class="px-4 py-2 space-x-2 flex">
                            <div class="flex-1">{{ $tenderDocument->document_type }}</div>
                            <div class="shrink-0 flex space-x-3">
                                <x-text-link target="_blank" href="{{ $tenderDocument->document_url }}">Download</x-text-link>
                                <x-text-link color="red" href="#" x-data="{}" x-on:click.prevent="$wire.emitTo(
                                    'tenants.tenders.delete',
                                    'showDeleteModal',
                                    '{{ $tenderDocument->id }}',
                                    'Confirm Deletion',
                                    'Are you sure you want to remove the tender document: <strong>{{ $tenderDocument->document_type }}</strong>?'
                                )">Delete</x-text-link>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-slate-500">No documents uploaded yet.</div>
            @endif
        </x-card-form>
    </x-section-centered>


    <x-modal-simple name="tender-create" form-action="saveDocument">
        <x-slot name="title">Upload Tender Document</x-slot>

        <x-input
            label="Tender Document Type" 
            name="document_type"
            wire:model.defer="document_type" 
            placeholder="eg. Corrigendum I, Volume I"
        />

        <div>
            <x-label for="document_url" class="mb-1">Tender Document Link</x-label>
            
            <div class="text-xs">
                Log in to your Google Drive account. <br>

                <ol class="list-decimal mb-4 list-inside">
                    <li>Right-click on the file you want to share and select "Get shareable link."</li>
                    <li>Choose the level of access you want to grant for the link (e.g. "Anyone with the link can view").</li>
                    <li>Copy the generated link.</li>
                    <li>In the input field, paste the copied link.</li>
                    <li>Press the Save Document button to add the link.</li>
                </ol>

                <x-input
                    type="url"
                    name="document_url"
                    wire:model.defer="document_url" 
                    placeholder="Enter you Google Drive shareable link"
                />
            </div>
        </div>

        <x-slot name="footer">
            <x-button with-spinner wire:target="saveDocument">Save Document</x-button>
        </x-slot>
    </x-modal-simple>

    <livewire:tenants.tenders.delete />
</div>





