<div>
    <x-slot name="title">All Notices</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Notices
    </x-slot>

    @can('super')
    <x-slot name="action">
        <x-button tag="a" href="{{ route('notices.create') }}" with-icon icon="add">Add Notice</x-button>
    </x-slot>
    @endcan

    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if($notices->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Role</x-table.thead>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>Created At</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notices as $notice)
                        <tr>
                            <x-table.tdata>
                                <x-badge variant="{{ $notice->type_color }}">{{ $notice->type?->name }}</x-badge>
                            </x-table.tdata>
                            <x-table.tdata class="uppercase">
                                <x-badge variant="{{ $notice->status == 'archive' ? 'warning' : 'success' }}">{{ $notice->status }}</x-badge>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $notice->role }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $notice->title }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @date($notice->created_at)
                            </x-table.tdata>
                            <x-table.tdata class="w-20">
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('notices.show', $notice->id) }}" />
                                    <x-button-icon-delete href="#" x-data="" x-data="{ tooltip: 'Delete' }"
                                        x-tooltip="tooltip" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'notices.delete',
                                                    'showDeleteModal',
                                                    '{{ $notice->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to delete this notice?',
                                                    '{{ $notice->title }}'
                                                )" />
                                    <x-button-icon-transfer href="#" x-data="" x-data="{ tooltip: '{{ $notice->status == 'archive' ? 'Active' : 'Archive' }}' }"
                                        x-tooltip="tooltip" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'notices.archive',
                                                    'showDeleteModal',
                                                    '{{ $notice->id }}',
                                                    'Confirm {{ $notice->status == 'archive' ? 'Active' : 'Archive' }}',
                                                    'Are you sure you want to {{ $notice->status == 'archive' ? 'active' : 'archive' }} this notice?',
                                                    '{{ $notice->title }}',
                                                    '{{ $notice->status == 'archive' ? 'Yes, Active' : 'Yes, Archive' }}'
                                                )" />
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

        @if ($notices->hasPages())
        <div class="mt-5">{{ $notices->links() }}</div>
        @endif
    </x-section-centered>
    <livewire:notices.delete />
    <livewire:notices.archive />
</div>