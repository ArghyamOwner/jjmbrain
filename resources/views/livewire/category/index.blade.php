<div>
    <x-slot name="title">Categories</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Categories
            </x-slot>
            <x-slot name="action">
                <x-button tag="a" href="{{ route('category.create') }}" with-icon icon="add">
                    New Category
                </x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($categories->isNotEmpty())
                <x-table.table :rounded="false">

                    <thead>
                        <tr>
                            <x-table.thead>Category</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $issue)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('category.show', $issue->id) }}">
                                    {{-- <x-text-link href="#"> --}}
                                        {{ $issue->name }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($issue->status)
                                        <x-badge variant="success">Active</x-badge>
                                    @else
                                        <x-badge variant="success">In-Active</x-badge>
                                    @endif
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>
        @if ($categories->hasPages())
            <div class="mt-5">{{ $categories->links() }}</div>
        @endif
    </x-section-centered>

</div>
