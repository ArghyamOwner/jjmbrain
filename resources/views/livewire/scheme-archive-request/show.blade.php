<div>
    <x-slot name="title">Scheme Archive Request</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('archiveRequests') }}">All Archive Requests</x-text-link>
            </x-slot>

            <x-slot:title>
                Archive Request - {{ $request->scheme_name }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-5">
            <x-alertbox variant="error" :close="false">Please review the scheme details and verify them with the
                division. After obtaining approval for archive, kindly provide an appropriate reason for archive.
            </x-alertbox>
        </div>

        <x-card no-padding>
            <div class="grid grid-cols-4">
                <div class="col-span-2 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">SMT | IMIS - ID</div>
                    <div class="text-gray-800 text-xs">
                        IMIS : {{ $request->imis_id ?? 'N/A' }} | SMT : {{ $request->smt_id ?? 'N/A'
                        }}
                    </div>
                </div>

                <div class="col-span-4 md:col-span-2 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Scheme Name</div>
                    <div class="text-gray-800">{{ $request->scheme_name }}</div>
                </div>

                <div class="col-span-2 px-4 py-2 md:col-span-1 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Division</div>
                    <div class="text-gray-800">{{ $request->division?->name }}</div>
                </div>

                <div class="col-span-4 md:col-span-4 px-4 py-2 border-t border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Reason for Requesting to Archive the
                        Scheme </div>
                    <div class="text-gray-800">{{ $request->reason ?? 'N/A' }}</div>
                </div>

                <div class="col-span-2 px-4 py-2 md:col-span-1 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Status</div>
                    <div class="text-gray-800">{!! $request->status_name ?? 'N/A' !!}</div>
                </div>

                <div class="col-span-4 md:col-span-2 px-4 py-2 border-t border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Requested By</div>
                    <div class="text-gray-800">
                        {{ $request->createdBy ? ($request->createdBy->name .($request->createdBy->phone ? " ( "
                        .$request->createdBy->phone." )" : 'N/A')) : 'N/A' }}</div>
                </div>

                <div class="col-span-4 md:col-span-1 px-4 py-2 border-t border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Requested At</div>
                    <div class="text-gray-800">
                        {{ $request->created_at?->diffForHumans() }}</div>
                </div>


                @if($request->status != 'pending')
                <div class="col-span-4 md:col-span-2 px-4 py-2 border-t border-b border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Updated By / (Updated At)</div>
                    <div class="text-gray-800">
                        {{ $request->checkedBy ? ($request->checkedBy->name .($request->updated_at ? " ( "
                        .$request->updated_at." )" : 'N/A')) : 'N/A' }}</div>
                </div>
                <div class="col-span-4 md:col-span-2 px-4 py-2 border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Admin Comment for Deletion of the
                        Scheme </div>
                    <div class="text-gray-800">{{ $request->comment ?? 'N/A' }}</div>
                </div>
                @endif

                @if($showDeleteRequestOption)
                <div class="flex flex-wrap w-full items-center px-4 py-3 col-span-4 border-t">
                    <x-button-icon-delete x-on:click.prevent="$wire.emitTo(
                        'scheme-archive-request.delete',
                        'showDeleteModal',
                        '{{ $request->id }}',
                        'Confirm Deletion',
                        'Are you sure you want to delete the archive request?'
                    )" /> <span class="text-red-600">
                        Delete Request
                    </span>
                </div>
                @endif
            </div>
        </x-card>

        @if($request->status === 'pending')
        <div class="mt-6">
            <livewire:scheme-archive-request.update-status :request="$request"
                wire:key="request-{{ $request->id }}" />
        </div>
        @endif
    </x-section-centered>

    <livewire:scheme-archive-request.delete />
</div>