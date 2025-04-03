<div>
    <x-card no-padding overflow-hidden>
        @if($requests->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        {{-- <x-table.thead>Scheme Name</x-table.thead> --}}
                        <x-table.thead>Division</x-table.thead>
                        <x-table.thead>Status</x-table.thead>
                        <x-table.thead>Created At</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        {{-- <x-table.tdata>
                            <x-text-link href="{{ route('archiveRequests.show', $request->id) }}">
                                {{ $request->scheme_name }}
                            </x-text-link>
                            <p class="text-xs">
                                IMIS : {{ $request->imis_id ?? 'N/A' }} | SMT : {{ $request->smt_id ?? 'N/A'
                                }}
                            </p>
                        </x-table.tdata> --}}
                        <x-table.tdata>
                            {{ $request->division?->name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {!! $request->status_name !!}
                        </x-table.tdata>
                        <x-table.tdata>
                            @date($request->created_at)
                        </x-table.tdata>

                        @if(auth()->user()->id === $request->created_by || auth()->user()->isAdministrator())
                        @if($request->status === 'pending')    
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                {{-- <x-button-icon-show href="{{ route('archiveRequests.show', $request->id) }}" /> --}}
                                <x-button-icon-delete x-on:click.prevent="$wire.emitTo(
                                    'scheme-archive-request.delete',
                                    'showDeleteModal',
                                    '{{ $request->id }}',
                                    'Confirm Deletion',
                                    'Are you sure you want to delete the archive request?'
                                )" />
                            </div>
                        </x-table.tdata>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No archive requests found.</p>
        </x-card-empty>
        @endif
    </x-card>
    <livewire:scheme-archive-request.delete />
</div>