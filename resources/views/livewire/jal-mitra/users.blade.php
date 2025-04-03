<div>
    <x-slot name="title">Jal-Mitra Users</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Jal-Mitra Users
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <x-heading>Total : {{ $totalJm }}</x-heading>
                <div>
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="division" wire:model="division">
                    <option value="all">-- Select Division --</option>
                    @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                    @endforeach
                </x-select>
                <x-select no-margin name="district" wire:model="district">
                    <option value="all">-- Select District --</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>
                <x-select no-margin name="hasScheme" wire:model="hasScheme">
                    <option value="all">-- Select Option --</option>
                    <option value="yes">With Schemes</option>
                    <option value="no">Without Schemes</option>
                </x-select>
                <x-select no-margin name="status" wire:model="status">
                    <option value="all">-- Select Status --</option>
                    <option value="active">Active</option>
                    <option value="blocked">Blocked</option>
                </x-select>
            </div>

            @if ($users->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Name</x-table.thead>
                                <x-table.thead>Joining Doc</x-table.thead>
                                <x-table.thead>Division</x-table.thead>
                                <x-table.thead>District</x-table.thead>
                                <x-table.thead>Scheme</x-table.thead>
                                <x-table.thead>Status</x-table.thead>
                                @if ($showEditButton)
                                <x-table.thead>Action</x-table.thead>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link href="#">
                                            {{ $user->name }}
                                        </x-text-link>
                                        <p>{{ $user->phone }}</p>
                                        <p>DOJ : {{ $user->doj?->format('d-m-Y') ?? 'N/A' }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @if($user->joining_document_url)
                                        <x-button tag="a" target="_blank" href="{{ $user->joining_document_url }}" color="cyan"
                                            with-icon icon="download">Joining Document
                                        </x-button>
                                        @else
                                        -
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $user->division_names }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $user->district_names ?? '-' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @if($user->scheme)
                                        <x-text-link href="{{ route('schemes.show', $user->scheme?->id) }}">
                                        {{ $user->scheme?->name }}
                                        </x-text-link> 
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-badge
                                            variant="{{ $user->user_status_color }}">{{ $user->user_status }}</x-badge>
                                    </x-table.tdata>
                                    @if ($showEditButton)
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-edit href="{{ route('admin.users.edit', $user->id) }}" />
                                        </div>
                                    </x-table.tdata>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($users->hasPages())
            <div class="mt-5">{{ $users->links() }}</div>
        @endif
    </x-section-centered>
</div>
