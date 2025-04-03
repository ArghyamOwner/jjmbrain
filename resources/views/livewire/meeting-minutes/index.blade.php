<div>
    <x-slot name="title">Meetings</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Meetings
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('meetingMinutes.create') }}" with-icon icon="add">New Meeting</x-button> 
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
                                <x-table.thead>User Group</x-table.thead>
                                <x-table.thead>Vertical</x-table.thead>
                                <x-table.thead>Venue / Link</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meetings as $meeting)
                                <tr>
                                    <x-table.tdata>
                                        {{ $meeting->meeting_name }}
                                        <p>
                                            <x-badge class="mb-2" variant="success">{{ $meeting->type }}</x-badge>
                                        </p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @dateWithTime($meeting->meeting_date)
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $meeting->user_group }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $meeting->vertical_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $meeting->venue ?? $meeting->link }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            {{-- <x-button-icon-delete 
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
                                            /> --}}
                                            <x-button-icon-show href="{{ route('meetingMinutes.show', $meeting->id) }}" />
                                        </div>
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>

                {{-- <livewire:meetings.delete /> --}}
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($meetings->hasPages())
            <div class="mt-5">{{ $meetings->links() }}</div>
        @endif
    </x-section-centered>
</div>