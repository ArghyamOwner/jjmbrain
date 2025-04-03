<div>
    <x-slot name="title">All WUC(s)</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                WUC(s)
    </x-slot>
    @if(auth()->user()->isIsaCoordinator() || auth()->user()->isAdministratorOrSuper())
    <x-slot name="action">
        <x-button tag="a" href="{{ route('wucs.create') }}" with-icon icon="add">New WUC</x-button>
    </x-slot>
    @endif
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search WUCs..." />
                    </div>

                    <div class="pt-6">
                        <div class="space-x-2 items-center">
                            <x-button type="button" color="white" x-on:click="showFilter = !showFilter">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Filter
                            </x-button>
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>
                </div>

                <div x-show="showFilter" x-collapse
                    class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">

                    <x-select no-margin name="district" wire:model="district">
                        <option value="all">--Select District--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="revenue_circle_id" wire:model="revenue_circle_id">
                        <option value="all">--Select Revenue Circle--</option>
                        @foreach ($circles as $circlekey => $val)
                        <option value="{{ $circlekey }}">{{ $val }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="block_id" wire:model="block_id">
                        <option value="all">--Select Block--</option>
                        @foreach ($blocks as $blockKey => $blockVal)
                        <option value="{{ $blockKey }}">{{ $blockVal }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="show" wire:model="show">
                        <option value="">--Select Option--</option>
                        <option value="bank">Having Bank Details</option>
                        <option value="withoutBank">Without Bank Details</option>
                    </x-select>

                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            {{-- <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-5">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search..." />
                </div>

                <div class="md:col-span-2">
                    <x-select no-margin name="issuingAuthority" wire:model="issuingAuthority">
                        <option value="">--Issuing Authority--</option>
                        @foreach ($this->issuingAuthorities as $issuingAuthorityValue)
                        <option value="{{ $issuingAuthorityValue }}">{{ $issuingAuthorityValue }}</option>
                        @endforeach
                    </x-select>
                </div>

                <x-button color="white" wire:click="resetFilter">Reset Filter</x-button>
            </div> --}}

            @if ($wucs->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>District | Revenue Circle</x-table.thead>
                            <x-table.thead>Block</x-table.thead>
                            <x-table.thead>Formation Date</x-table.thead>
                            <x-table.thead>Scheme</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wucs as $wuc)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('wucs.show', $wuc->id) }}">{{ $wuc->name }}</x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $wuc?->district?->name }}
                                <p>{{ $wuc?->revenueCircle?->name }}</p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $wuc?->block?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @date($wuc->formation_date)
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-readmore content="{{ $wuc->scheme_names ?? '-' }}" limit="20"
                                    link-class="text-indigo-600 underline whitespace-normal" />
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('wucs.show', $wuc->id) }}" />
                                    
                                    @if($showDeleteButton)
                                        <x-button-icon-delete 
                                            href="#" 
                                            x-data=""
                                            x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'wucs.delete',
                                                'showDeleteModal',
                                                '{{ $wuc->id }}',
                                                'Confirm Deletion',
                                                'All the data related to this WUC will be deleted. Are you sure you want to delete this WUC ?',
                                                '{{ $wuc->name }}'
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
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($wucs->hasPages())
        <div class="mt-5">{{ $wucs->links() }}</div>
        @endif
    </x-section-centered>
    <livewire:wucs.delete />
</div>