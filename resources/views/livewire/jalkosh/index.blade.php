<div>
    <x-slot name="title">All Jal Kosh</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
               All Jal Kosh
            </x-slot>

            <x-slot:action>
                <x-button with-icon icon="add" tag="a" href="{{ route('jalkoshlinks.create') }}">Add Jal Kosh</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($jalkoshLinks->isNotEmpty())
            <div class="my-3">
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Link</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            {{-- <x-table.thead>Action</x-table.thead> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jalkoshLinks as $jalkoshLink)
                            <tr>
                                <x-table.tdata>
                                    {{ $jalkoshLink->link_type }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jalkoshLink->external_link }}
                                    <x-text-link
                                        herf="{{ $jalkoshLink->attachment_url }}">{{ $jalkoshLink->attachment_url }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-badge :withdot="false" variant="{{ $jalkoshLink->status->color() }}">{{ $jalkoshLink->status?->value }}</x-badge>
                                </x-table.tdata>
                                {{-- <x-table.tdata>
                                    
                                </x-table.tdata> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>

            {{ $jalkoshLinks->links() }}
        @else
            <x-card-empty />
        @endif
        </x-section-centered>
</div>