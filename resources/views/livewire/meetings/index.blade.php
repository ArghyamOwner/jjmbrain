<div>
    <x-slot name="title">All Meetings</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Meetings
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('meetings.create') }}" with-icon icon="add">New meeting</x-button> 
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if($meetings->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Title</x-table.thead>
                                <x-table.thead>Date/Time</x-table.thead>
                                <x-table.thead>Venue</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meetings as $meeting)
                                <tr>
                                    <x-table.tdata>
                                        {{ $meeting->title }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @dateWithTime($meeting->date_time)
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $meeting->venue }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-delete 
                                                href="#" 
                                                x-data=""
                                                x-cloak
                                                x-on:click.prevent="$wire.emitTo(
                                                    'meetings.delete',
                                                    'showDeleteModal',
                                                    '{{ $meeting->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this meeting details?',
                                                    '{{ $meeting->title }}'
                                                )"
                                            />
                                        </div>
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>

                <livewire:meetings.delete />
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($meetings->hasPages())
            <div class="mt-5">{{ $meetings->links() }}</div>
        @endif
    </x-section-centered>
</div>