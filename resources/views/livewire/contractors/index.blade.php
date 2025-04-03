<div>
    <x-slot name="title">All Contractors</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Contractors
    </x-slot>

    <x-slot name="action">
        <x-button tag="a" href="{{ route('contractors.create') }}" with-icon icon="add">New contractor</x-button>
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:contractors.card />
        <x-card no-padding overflow-hidden class="mt-5">
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
            </div>

            @if ($contractors->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Entity Name | Bid No.</x-table.thead>
                                <x-table.thead>Email</x-table.thead>
                                <x-table.thead>Phone</x-table.thead>
                                <x-table.thead>Status</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contractors as $contractor)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link href="{{ route('contractors.show', $contractor->id) }}">
                                            {{ $contractor->user->name }}
                                        </x-text-link>
                                        <p>Bid No : {{ $contractor->bid_no ?? '-' }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $contractor->user->email }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $contractor->user->phone }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-badge variant="{{ $contractor->user->user_status_color }}">
                                            {{ $contractor->user->user_status }}</x-badge>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <div class="flex space-x-1">
                                            <x-button-icon-show
                                                href="{{ route('contractors.show', $contractor->id) }}" />
                                            @unless (auth()->user()->isExecutiveEngineer())
                                            <x-button-icon-edit
                                                href="{{ route('contractors.edit', $contractor->id) }}" />
                                            @endunless    
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

        @if ($contractors->hasPages())
            <div class="mt-5">{{ $contractors->links() }}</div>
        @endif
    </x-section-centered>
</div>
