<div>
    <x-slot name="title">All Tutorials</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Tutorials
            </x-slot>

            <x-slot name="action">
                @can('admin')
                    <x-button tag="a" href="{{ route('tutorials.create') }}" with-icon icon="add">New Tutorial</x-button>
                @endcan
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>
            @if ($tutorials->isNotEmpty())
                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Actor</x-table.thead>
                            <x-table.thead>Caption</x-table.thead>
                            <x-table.thead>Link</x-table.thead>
                            <x-table.thead>Attachment</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutorials as $tutorial)
                            <tr>
                                <x-table.tdata>
                                    {{ $tutorial->actor }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $tutorial->caption }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-text-link
                                        herf="{{ $tutorial->instruction_link }}">{{ $tutorial->instruction_link }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-button tag="a" color="blue" href="{{ $tutorial->instruction_attachment_url }}"
                                        with-icon icon="download" target="_blank">Download</x-button>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        <div class="mt-5">{{ $tutorials->links() }}</div>

    </x-section-centered>
</div>
