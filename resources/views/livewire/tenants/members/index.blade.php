<div>
    <x-slot name="title">Members</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Members
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('tenant.members.create') }}" with-icon icon="add">New member</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-input-search wire:model.debounce.500ms="search" placeholder="Search..." class="w-full md:w-1/2 mb-4" />
        
        @if($members->isNotEmpty())
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Designation</x-table.thead>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Work Details</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>Ward number</x-table.thead>
                            <x-table.thead></x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <x-table.tdata>
                                    {{ $member->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $member->designation }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ Str::headline($member->type) }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $member->work_details }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $member->phone }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $member->ward_number }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-link href="{{ route('tenant.members.edit', $member->id) }}">Edit</x-link>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <div class="mt-5">{{ $members->links() }}</div>
        @else 
        <x-card-empty />
    @endif
    </x-section-centered>
</div>
