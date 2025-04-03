<div>
    <x-slot name="title">All Grievances</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Grievances
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin name="search" wire:model.debounce.600ms="search"
                            placeholder="Search..." />
                    </div>

                    <div>
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

                <div x-show="showFilter" x-collapse class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">
                    <x-select no-margin name="division" wire:model="division">
                        <option value="all">Select a Division</option>
                        @foreach($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="priority" wire:model="priority">
                        <option value="all">Select a Priority</option>
                        @foreach($this->priorities as $priorityKey => $priorityName)
                        <option value="{{ $priorityKey }}">{{ $priorityName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="status" wire:model="status">
                        <option value="all">Select a status</option>
                        @foreach($this->statuses as $statusKey => $statusName)
                        <option value="{{ $statusKey }}">{{ $statusName }}</option>
                        @endforeach
                    </x-select>
                    
                    <x-select no-margin name="platform" wire:model="platform">
                        <option value="all">Select a Channel</option>
                        @foreach($platformOptions as $platKey => $platName)
                        <option value="{{ $platKey }}">{{ $platName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="category" wire:model="category">
                        <option value="all">Select a Category</option>
                        @foreach($this->categories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="subCategory" wire:model="subCategory">
                        <option value="all">Select a Sub-Category</option>
                        @foreach($this->subCategories as $subKey => $subValue)
                        <option value="{{ $subKey }}">{{ $subValue }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="sort" wire:model="sort">
                        <option value="all">Sort By</option>
                        <option value="desc">Newest</option>
                        <option value="asc">Oldest</option>
                    </x-select>
                </div>
            </div>
        </x-card>

        @if ($grievances->isNotEmpty())
        <x-card no-padding>
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>Ticket No / Created Date</x-table.thead>
                        <x-table.thead>Scheme / Division</x-table.thead>
                        <x-table.thead>Category / Sub-Category</x-table.thead>
                        <x-table.thead>Complainant</x-table.thead>
                        <x-table.thead>Status</x-table.thead>
                        <x-table.thead>Pendency</x-table.thead>
                        <x-table.thead>Pending At / Due Date</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grievances as $ticket)
                    <tr>
                        <x-table.tdata>
                            <div class="flex space-x-1 items-center leading-tight">
                                <x-text-link href="{{ route('grievances.show', $ticket->id) }}">
                                    {{ $ticket->reference_no }}
                                </x-text-link>
                            </div>
                            <span class="text-sm">
                                {{ $ticket->created_at ? $ticket->created_at->toFormattedDateString() : '' }}
                            </span>
                            <p class="space-x-2">
                                <x-badge variant="{{ $ticket->priority_color }}">{{ $ticket->priority ?? 'Low' }}</x-badge>
                                <x-badge variant="{{ $ticket->platform_color }}">{{ $ticket->platform ?? 'web' }}</x-badge>
                            </p>
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-readmore content="{{ $ticket->scheme?->name ?? '-' }}" limit="15"
                                link-class="text-indigo-600 underline whitespace-normal" />
                            <p>Division : {{ $ticket->division?->name ?? '' }}</p>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $ticket->category?->name ?? '-' }}
                            <p class="text-sm">
                                {{ $ticket->subCategory ? 'Sub-Cat : '.$ticket->subCategory?->name : '-' }}
                            </p>
                        </x-table.tdata>
                        <x-table.tdata class="capitalize">
                            {{ $ticket->citizen_name ?? '' }}
                        </x-table.tdata>
                        <x-table.tdata class="capitalize">
                            {{ $ticket->status ?? '' }}
                        </x-table.tdata>
                        <x-table.tdata class="capitalize">
                            {{ $ticket->pendency ?? '-' }}
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($ticket->latestAssignedTask)
                            {{ $ticket->latestAssignedTask?->assignedTo?->name ?? '' }}
                            <p class="text-sm">{{ $ticket->latestAssignedTask?->due_date->format('d-m-Y') }}</p>
                            @else
                            NA
                            @endif
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </x-card>
        @if ($grievances->hasPages())
        <div class="mt-5">{{ $grievances->links() }}</div>
        @endif
        @else
        <x-card-empty />
        @endif
    </x-section-centered>
</div>