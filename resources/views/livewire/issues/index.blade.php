<div>
    <x-slot name="title">Issues</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Issues
    </x-slot>
    <x-slot name="action">
        <x-button tag="a" href="{{ route('issues.create') }}" with-icon icon="add">
            New Issue
        </x-button>
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($issues->isNotEmpty())
                <x-table.table :rounded="false">

                    <thead>
                        <tr>
                            <x-table.thead>Issue</x-table.thead>
                            <x-table.thead>Category / Sub-Category</x-table.thead>
                            <x-table.thead>SLA</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($issues as $issue)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('issues.show', $issue->id) }}">
                                        {{-- <x-text-link href="#"> --}}
                                        {{ $issue->issue }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata class="capitalize text-sm">
                                    {{ $issue?->category?->name }}
                                    <p>{{ $issue?->subCategory?->name }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $issue->sla }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button color="blue" tag="a" href="#" x-data class="w-30"
                                            x-on:click.prevent="Livewire.emit('editIssueSlideover', '{{ $issue->id }}')"
                                            x-cloak>
                                            Edit
                                        </x-button>

                                        <x-button-icon-delete
                                            x-on:click.prevent="$wire.emitTo(
                                                'issues.delete',
                                                'showDeleteModal',
                                                '{{ $issue->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this issue?',
                                                '{{ $issue->issue }}'
                                            )" />

                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>
        @if ($issues->hasPages())
            <div class="mt-5">{{ $issues->links() }}</div>
        @endif
    </x-section-centered>
</div>

<livewire:issues.edit />

<livewire:issues.delete />
