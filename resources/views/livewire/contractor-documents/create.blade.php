<div>
    @if ($contractorDocumentDetails->isNotEmpty())
        <div class="mb-8">
            <x-heading size="lg" class="mb-2">Documents Submitted</x-heading>
            <x-card no-padding overflow-hidden> 
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Document Type</x-table.thead>
                            <x-table.thead>Download</x-table.thead>
                            <x-table.thead>Created on</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contractorDocumentDetails as $contractorDocumentDetail)
                            <tr>
                                <x-table.tdata>
                                    {{ $contractorDocumentDetail->document_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-text-link 
                                        href="{{ $contractorDocumentDetail->document_url }}"
                                        download
                                    >Download</x-text-link>
                                    <span class="text-sm text-slate-400 uppercase">{{ $contractorDocumentDetail->extension }} ({{ Str::bytesToHuman($contractorDocumentDetail->size) }})</span>
                                </x-table.tdata>
                                <x-table.tdata>
                                    @date($contractorDocumentDetail->created_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-button-icon-delete 
                                        href="#" 
                                        x-data=""
                                        x-cloak
                                        x-on:click.prevent="$wire.emitTo(
                                            'contractor-documents.delete',
                                            'showDeleteModal',
                                            '{{ $contractorDocumentDetail->id }}',
                                            'Confirm Deletion',
                                            'Are you sure you want to remove this document from contractor?',
                                            '{{ $contractorDocumentDetail->document_name }}'
                                        )"
                                    />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>
        </div>
    @endif

    @if ($this->documents)
        <div class="mb-8">
            <x-heading size="lg" class="mb-2">Documents to be uploaded</x-heading>
            <x-card class="py-0">
                <div class="divide-y">
                    @foreach($this->documents as $document)
                        <form wire:submit.prevent="save">
                            <div class="grid grid-cols-1 md:grid-cols-4 py-5 gap-4">
                            <div class="md:col-span-2">
                                <x-filepond
                                        label="{{ Str::title($document->value) }}"
                                        name="contractordocuments.{{ Str::camel($document->value) }}"
                                        wire:model="contractordocuments.{{ Str::camel($document->value) }}"
                                /> 
                            </div>
                            <div>
                                <x-button class="md:mt-6 py-2.5" type="submit" wire:target="save,contractordocuments.{{ Str::camel($document->value) }}">Save document</x-button>
                            </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </x-card>
        </div>
    @endif

    @push('styles')
        <style>
            .filepond--root {
                min-height: 42px;
            }
            .filepond--root .filepond--drop-label {
                min-height: 42px;
            }
            .filepond--drop-label label {
                font-size: 0.875em;
            }
        </style>
    @endpush

    <livewire:contractor-documents.delete />

    @include('partials.js._filepond-scripts')
</div>
