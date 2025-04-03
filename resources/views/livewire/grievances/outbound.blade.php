<div>
    <x-slot name="title">Outbound Calls</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('grievanceDashboard') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Campaign Name : {{ $this->campaign->name }}
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card no-padding overflow-hidden>
                <div class="p-3 border-b grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- <x-heading>Total:{{ $beneficiariesCount }}</x-heading> --}}
                    <x-heading>Total:{{ $usersCount }}</x-heading>

                    <div class="md:col-span-2">
                        <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                            placeholder="Search..." />
                    </div>

                    {{-- <x-select no-margin name="division" wire:model="division">
                        <option value="all">--Select Division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select> --}}
                </div>

                {{-- @if ($beneficiaries->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>FHTC Number</x-table.thead>
                            <x-table.thead>Survey</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beneficiaries as $beneficiary)
                        <tr>
                            <x-table.tdata>
                                {{ $beneficiary->scheme?->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $beneficiary->beneficiary_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-text-link href="tel:{{ $beneficiary->beneficiary_phone }}">{{
                                    $beneficiary->beneficiary_phone }}</x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $beneficiary->fhtc_number }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-text-link href="{{ route('surveys.create', $beneficiary->id) }}">Take Survey
                                    </x-text-link>
                                    @if ($beneficiary->latestSurvey)
                                    <span>|</span>
                                    <x-text-link
                                        href="{{ route('surveys.show', ['survey' => $beneficiary->latestSurvey?->id]) }}">
                                        View</x-text-link>
                                    @endif
                                </div>
                            </x-table.tdata>
                            <x-table.tdata class="w-20">
                                @if ($beneficiary->latestSurvey)
                                Called by {{ $beneficiary->latestSurvey?->calledBy?->name }} on
                                @date($beneficiary->latestSurvey?->created_at)
                                @else
                                <span>-</span>
                                @endif
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
                @else
                <x-card-empty class="shadow-none rounded-none" />
                @endif --}}

                @if ($users->isNotEmpty())
                    <x-table.table :table-condensed="true" :rounded="false">
                        <thead>
                            <tr>
                                <x-table.thead>Role</x-table.thead>
                                <x-table.thead>Name</x-table.thead>
                                <x-table.thead>Phone</x-table.thead>
                                <x-table.thead>Survey</x-table.thead>
                                <x-table.thead>Status</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <x-table.tdata>
                                        {{ Str::upper($user->role) }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $user->name }}
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-text-link href="tel:{{ $user->phone }}">{{ $user->phone }}</x-text-link>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-text-link href="{{ route('surveys.create', $user->id) }}">Take Survey
                                            </x-text-link>
                                            @if ($user->latestSurvey)
                                                <span>|</span>
                                                <x-text-link
                                                    href="{{ route('surveys.show', ['survey' => $user->latestSurvey?->id]) }}">
                                                    View</x-text-link>
                                            @endif
                                        </div>
                                    </x-table.tdata>
                                    <x-table.tdata class="w-20">
                                        @if ($user->latestSurvey)
                                            Called by {{ $user->latestSurvey?->calledBy?->name }} on
                                            @date($user->latestSurvey?->created_at)
                                        @else
                                            <span>-</span>
                                        @endif
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                @else
                    <x-card-empty class="shadow-none rounded-none" />
                @endif
            </x-card>

            @if ($users->hasPages())
                <div class="mt-5">{{ $users->links() }}</div>
            @endif

            {{-- @if ($beneficiaries->hasPages())
            <div class="mt-5">{{ $beneficiaries->links() }}</div>
            @endif --}}
        </x-section-centered>
</div>
