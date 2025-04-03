<div>
    <x-card no-padding overflow-hidden>
        @if ($esrComplaints->isNotEmpty() || ($esrComplaints->isEmpty() && $search))
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-5">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search ESR Compliance" />
                </div>
                <div class="md:col-span-1">
                    <x-button tag="a" color="red" href="{{ route('schemes.esrComplaintCreate', $schemeId) }}"
                        with-icon icon="add">Add New ESR Compliance
                    </x-button>
                </div>
            </div>
        @endif
        @if ($esrComplaints->isNotEmpty()) 
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>ESR Compliance Date</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>TPI Agency Name</x-table.thead>
                            <x-table.thead>TPI Officer Name</x-table.thead>
                            <x-table.thead>TPI Officer Phone</x-table.thead>
                            <x-table.thead>Created By</x-table.thead>
                            <x-table.thead>Document</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($esrComplaints as $esrComplaint)
                            <tr>
                                <x-table.tdata>{{ $esrComplaint->created_at?->format('F j, Y') }}</x-table.tdata>
                                <x-table.tdata>{{ $esrComplaint->status_format }}</x-table.tdata>
                                <x-table.tdata>{{ $esrComplaint->tpi_agency_format }}</x-table.tdata>
                                <x-table.tdata>{{ $esrComplaint->tpi_officer_name }}</x-table.tdata>
                                <x-table.tdata>{{ $esrComplaint->tpi_officer_phone }}</x-table.tdata>
                                <x-table.tdata>{{ $esrComplaint->createdBy?->name }}</x-table.tdata>
                                <x-table.tdata>
                                    <x-button-icon-eye href="{{ $esrComplaint->doc_file_url  }}" />
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-delete href="#" x-data="" x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'esr-complaint.delete',
                                                'showDeleteModal',
                                                '{{ $esrComplaint->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this ESR Compliance?',
                                           )" />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        @else
            <x-card-empty variant="">
                <p class="text-center text-slate-500 mb-3 text-sm">No ESR Compliance found.</p>
                <x-button tag="a" href="{{ route('schemes.esrComplaintCreate', $schemeId) }}" with-icon
                    icon="add">Add New ESR Compliance</x-button>
            </x-card-empty>
        @endif
    </x-card>
    @if ($esrComplaints->hasPages())
        <div class="mt-5">{{ $esrComplaints->links() }}</div>
    @endif
    {{-- EsrComplaint --}}
    {{-- <livewire:flood.delete /> --}}
    <livewire:esr-complaint.delete />
</div>
