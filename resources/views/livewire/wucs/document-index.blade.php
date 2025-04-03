<div>
    <x-heading size="md" class="mb-2 mt-5">Previous WUC Documents</x-heading>
    <x-table.table :table-condensed="true" :rounded="false">
        <thead>
            <tr>
                <x-table.thead>Name</x-table.thead>
                <x-table.thead>Document</x-table.thead>
                <x-table.thead>Updated At</x-table.thead>
                <x-table.thead>Updated By</x-table.thead>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->wuc->wucDocuments as $document)
            <tr>
                <x-table.tdata>
                    <span class="capitalize">{{ $document->type }}</span>
                </x-table.tdata>
                <x-table.tdata>
                    <x-button tag="a" target="_blank" href="{{ $document->document_url }}" color="white"
                        with-icon icon="download">Download Document</x-button>
                </x-table.tdata>
                <x-table.tdata>
                    @date($document->created_at)
                </x-table.tdata>
                <x-table.tdata>
                    {{ $document?->createdBy?->name ?? 'N/A'}}
                </x-table.tdata>
            </tr>
            @endforeach
        </tbody>
    </x-table.table>
</div>