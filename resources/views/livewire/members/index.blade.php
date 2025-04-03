<div>
    <x-slot name="title">Members</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Members
            </x-slot>

            @can('district-jaldoot-cell')
                <x-slot name="action">
                    <x-button tag="a" href="{{ route('members.create') }}" with-icon icon="add">New
                        Member</x-button>
                </x-slot>
            @endcan
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden class="mt-5">

            @if ($members->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>District</x-table.thead>
                                <x-table.thead>Name / Designation</x-table.thead>
                                <x-table.thead>Phone</x-table.thead>
                                <x-table.thead>Department</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <x-table.tdata>
                                        {{ $member->district?->name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $member->member_name }}
                                       <p> <x-badge>{{ $member->designation }}</x-badge> </p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $member->member_phone }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $member->department }}
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

        @if ($members->hasPages())
            <div class="mt-5">{{ $members->links() }}</div>
        @endif
    </x-section-centered>
</div>
