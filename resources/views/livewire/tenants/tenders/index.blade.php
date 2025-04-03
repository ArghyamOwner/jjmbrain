<div>
    <x-slot name="title">Tenders</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Tenders
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('tenant.tenders.create') }}" with-icon icon="add">New tender</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-input-search wire:model.debounce.500ms="search" placeholder="Search..." class="w-full md:w-1/2 mb-4" />
        
        @if($tenders->isNotEmpty())
            <x-card no-padding>
                <x-table.table>
                    {{-- <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach($tenders as $tender)
                            <tr>
                                <x-table.tdata>
                                    <x-heading size="lg">{{ $tender->name }}</x-heading>
                                    <div class="mt-1 text-sm text-slate-600 flex space-x-4">
                                        <div>Published date: @date($tender->publish_date)</div>
                                        <div>Due date: @date($tender->due_date)</div>
                                    </div>
                                    <x-link class="mt-1" href="{{ route('tenant.tenders.edit', $tender->id) }}">Edit Tender</x-link>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <div class="mt-5">{{ $tenders->links() }}</div>
        @else 
        <x-card-empty />
    @endif
    </x-section-centered>
</div>
