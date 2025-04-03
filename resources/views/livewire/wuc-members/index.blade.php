<div>
    <x-heading size="md" class="mb-2 mt-5">Members</x-heading>
    <x-card no-padding overflow-hidden>
        @if ($members->isNotEmpty())
        <div class="text-sm">
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Member Name</x-table.thead>
                        <x-table.thead>Phone</x-table.thead>
                        <x-table.thead>Designation</x-table.thead>
                        <x-table.thead>Actions</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                    <tr>
                        <x-table.tdata>
                            {{ $member->name }}
                            @if($member->user?->blocked_at)
                            <x-badge variant="danger">Blocked : {{ $member->user?->blocked_at?->diffForHumans() }}
                            </x-badge>
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $member->phone }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $member->designation_name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            @unless ($member->designation === 'president')    
                            <x-button-icon-delete x-on:click.prevent="$wire.emitTo(
                                        'wuc-members.delete',
                                        'showDeleteModal',
                                        '{{ $member->id }}',
                                        'Confirm Deletion',
                                        'Are you sure you want to remove this member?',
                                        '{{ $member->name }}'
                                    )" />
                            @endunless
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty class="shadow-none rounded-none" />
        @endif
    </x-card>
    <livewire:wuc-members.delete />
</div>