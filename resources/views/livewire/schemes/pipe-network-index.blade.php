<div>
    <x-card no-padding overflow-hidden>
        @if($networks->isNotEmpty())
        {{-- <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4 text-right"> --}}
            {{-- <div class="md:col-span-5">
                <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                    placeholder="Search Item Name / Asset UIN..." />
            </div> --}}
            @unless (auth()->user()->isDc() || auth()->user()->isSdo())
            <div class="p-3 border-b text-right">
                <x-button tag="a" color="blue" href="{{ route('canalUploadNetwork', $schemeId) }}" with-icon
                    icon="add">Pipe Network Detail
                </x-button>
            </div>
            @endunless
        {{-- </div> --}}
        @endif

        @if($networks->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>File</x-table.thead>
                        <x-table.thead>Status</x-table.thead>
                        <x-table.thead>Verified By</x-table.thead>
                        <x-table.thead>Comment</x-table.thead>
                        <x-table.thead>Created By</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($networks as $network)
                    <tr>
                        <x-table.tdata>
                            @if($network->file_url)
                            <x-button tag="a" target="_blank" href="{{ $network->file_url }}" color="white" with-icon
                                icon="download">Json File
                            </x-button>
                            @else
                            -
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($network->verification_status == 'Accepted')
                            <x-badge variant="success">{{ $network->verification_status }}</x-badge>
                            
                            @elseif ($network->verification_status == 'Rejected')
                            <x-badge variant="danger">{{ $network->verification_status }}</x-badge>
                        
                            @else
                            <x-badge variant="warning">{{ $network->verification_status }}</x-badge>
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($network->verification_status)    
                            {{ $network->verifiedBy?->name }}
                            <span class="text-xs">({{ $network->verified_at?->diffForHumans() }})</span>
                            @else
                            -
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-readmore content="{{ $network->comment ?? '-' }}" limit="20"
                                link-class="text-indigo-600 underline whitespace-normal" />
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $network->createdBy?->name }}
                            <p>
                                @date($network->created_at)
                            </p>
                        </x-table.tdata>
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                <x-button-icon-show href="{{ route('verifyNetwork', $network->id) }}" />
                                    @if($showDeleteButton)
                                    <x-button-icon-delete x-cloak x-on:click.prevent="$wire.emitTo(
                                        'schemes.delete-scheme-pipe-network',
                                        'showDeleteModal',
                                        '{{ $network->id }}',
                                        'Confirm Deletion',
                                        'Are you sure you want to delete this Pipe Network Json ?',
                                    )" />
                                    @endif
                            </div>
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No Scheme Pipe Network Found.</p>
            @unless (auth()->user()->isDc() || auth()->user()->isSdo())
            <x-button tag="a" href="{{ route('canalUploadNetwork', $schemeId) }}" with-icon icon="add">Upload Pipe
                Network Details
            </x-button>
            @endunless
        </x-card-empty>
        @endif
    </x-card>
    <livewire:schemes.delete-scheme-pipe-network />
</div>