<div>
    <x-slot name="title">Activity Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Activity Details
    </x-slot>
    @if($showAddButton)
    <x-slot name="action">
        <x-button tag="a" href="{{ route('activityDetails.create') }}" with-icon icon="add">
            New Activity Details
        </x-button>
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
                            placeholder="Search Activity..." />
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

                    <x-select no-margin name="district_id" wire:model="district_id">
                        <option value="all">--Select District--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="block_id" wire:model="block_id">
                        <option value="all">--Select Block--</option>
                        @foreach ($blocks as $blockKey => $blockVal)
                        <option value="{{ $blockKey }}">{{ $blockVal }}</option>
                        @endforeach
                    </x-select>

                </div>
            </div>
        </x-card>
        <x-card no-padding overflow-hidden>
            @if ($activities->isNotEmpty())
            <x-table.table :rounded="false">

                <thead>
                    <tr>
                        <x-table.thead>Activity | Date</x-table.thead>
                        <x-table.thead>District | Block | Panchayat</x-table.thead>
                        <x-table.thead>Phase</x-table.thead>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($activities as $activityD)
                    <tr>
                        <x-table.tdata>
                            <x-text-link href="{{ route('activityDetails.show', $activityD->id) }}">
                                {{-- <x-text-link href="#"> --}}
                                    {{ $activityD?->activity?->name ?? '-' }}</x-text-link>
                                <span class="text-sm">
                                    <p>
                                        @date($activityD->date)
                                        @if($activityD->district_user_id)
                                            <x-badge variant="success">ISA Approved</x-badge>
                                        @endif
                                    </p>
                                    <p>
                                        @if($activityD->district_user_id)
                                            <x-badge variant="success">ISA Approved</x-badge>
                                        </div>
                                        @else
                                            <x-badge variant="danger">Not Approved</x-badge>
                                        @endif
                                    </p>
                                    
                                </span>
                        </x-table.tdata>
                        <x-table.tdata>
                            <span class="text-sm">
                                {{ $activityD?->district?->name ?? '-' }}
                                <p>
                                    {{ $activityD?->block?->name ?? '-' }}
                                </p>
                                <p>
                                    {{ $activityD?->panchayat?->panchayat_name ?? '-' }}
                                </p>
                            </span>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $activityD->phase_name ?? '-' }}
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
            @else
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>
        @if ($activities->hasPages())
        <div class="mt-5">{{ $activities->links() }}</div>
        @endif
    </x-section-centered>

</div>