<div>
    <x-card no-padding overflow-hidden>
        @if($beneficiaries->isNotEmpty() || ($beneficiaries->isEmpty() && $search))
        <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-4">
                <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search beneficiary name / phone..." />
            </div>
            <x-button type="button" color="indigo" wire:click="export" wire:target="export"
                with-spinner>Export
            </x-button>
            @if($showDeleteAllButton)  
            <x-button 
                type="button" color="red"
                with-spinner
                href="#" 
                x-data=""
                x-cloak
                x-on:click.prevent="$wire.emitTo(
                    'beneficiaries.delete-all',
                    'showDeleteModal',
                    '{{ $schemeId }}',
                    'Confirm Deletion',
                    'All data related to Beneficieries will be deleted. Are you sure you want to delete all the beneficiaries?',
                )"
            >Delete All </x-button>
            @endif
        </div>
        @endif

        @if($beneficiaries->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Beneficiary Name</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>FHTC Number</x-table.thead>
                            <x-table.thead>Identity</x-table.thead>
                            <x-table.thead>Location</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beneficiaries as $beneficiary)
                            <tr>
                                <x-table.tdata> 
                                    <div class="flex items-center">
                                        <div class="shrink-0 w-8 h-8 rounded-full bg-slate-100 mr-2">
                                            @if($beneficiary->beneficiary_photo)
                                            <x-lightbox>
                                                <x-lightbox.item image-url="{{ $beneficiary->beneficiary_photo_url }}">
                                                        <div class="bg-slate-50 w-8 h-8 rounded-full">
                                                            <img src="{{ $beneficiary->beneficiary_photo_url }}"
                                                                class="object-fit w-8 h-8 rounded-full" loading="lazy">
                                                        </div>
                                                </x-lightbox.item>
                                            </x-lightbox>
                                            @else
                                            <img src="{{ $beneficiary->beneficiary_photo_url }}" alt="beneficiary_photo"
                                                loading="lazy"
                                                class="object-fit w-8 h-8 rounded-full"
                                            >
                                            @endif
                                        </div>
                                        <div>
                                            {{ $beneficiary->beneficiary_name }}
                                        </div>
                                    </div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $beneficiary->beneficiary_phone }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $beneficiary->fhtc_number ?? '-' }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    Voter : <span class="uppercase italic">{{ $beneficiary->beneficiary_voter_number ?? '-' }}</span>
                                    <p>Aadhar : <span class="uppercase italic">{{ $beneficiary->beneficiary_aadhaar ?? '-' }}</span></p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    Lat : {{ $beneficiary->latitude }}
                                    <p>Long : {{ $beneficiary->longitude }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="{{ route('beneficiaries.edit', $beneficiary->id) }}" />
                                        @if($showDeleteButton)    
                                        <x-button-icon-delete 
                                            href="#" 
                                            x-data=""
                                            x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'beneficiaries.delete',
                                                'showDeleteModal',
                                                '{{ $beneficiary->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this beneficiary?',
                                                '{{ $beneficiary->beneficiary_name }}'
                                            )"
                                        />
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
                <p class="text-center text-slate-500 mb-3 text-sm">No beneficiary user found.</p>
                @unless (auth()->user()->isDc())
                <x-button tag="a" href="{{ route('schemes.beneficiaryCreate', $schemeId) }}" with-icon icon="add">Add New Beneficiary</x-button>
                @endunless
            </x-card-empty>
        @endif
    </x-card>
    @if ($beneficiaries->hasPages())
    <div class="mt-5">{{ $beneficiaries->links() }}</div>
    @endif
    <livewire:beneficiaries.delete />
    <livewire:beneficiaries.delete-all />
</div>
