<div>
    <x-card no-padding overflow-hidden>

        @if ($wucs->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>District | Revenue Circle</x-table.thead>
                            <x-table.thead>Block</x-table.thead>
                            <x-table.thead>Formation Date</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wucs as $wuc)
                            <tr>
                                <x-table.tdata>
                                    {{ $wuc->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $wuc?->district?->name }}
                                    <p>{{ $wuc?->revenueCircle?->name }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $wuc?->block?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @date($wuc->formation_date)
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-show href="{{ route('wucs.show', $wuc->id) }}" />
                                        {{-- <x-button-icon-edit href="#" /> --}}
                                        {{-- <x-button-icon-delete 
                                            href="#" 
                                            x-data=""
                                            x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'tasks.delete',
                                                'showDeleteModal',
                                                '{{ $tasksFeed->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this tasks details?',
                                                '{{ $tasksFeed->title }}'
                                            )"
                                        /> --}}
                                        @if($showDeleteButton)
                                        <x-button-icon-delete 
                                            href="#" 
                                            x-data=""
                                            x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'wucs.delete',
                                                'showDeleteModal',
                                                '{{ $wuc->id }}',
                                                'Confirm Deletion',
                                                'All the data related to this WUC will be deleted. Are you sure you want to delete this WUC ?',
                                                '{{ $wuc->name }}'
                                            )"
                                        />
                                        @endif
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

    @if ($wucs->hasPages())
        <div class="mt-5">{{ $wucs->links() }}</div>
    @endif
    <livewire:wucs.delete />
</div>
