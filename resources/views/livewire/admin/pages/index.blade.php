<div>
    <x-slot name="title">All Pages</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Pages
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('admin.pages.create') }}" with-icon icon="add">New page</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if($pages->isNotEmpty())
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>URL</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Published at</x-table.thead>
                            <x-table.thead></x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <x-table.tdata>
                                    {{ $page['title'] }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $page['slug'] }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-badge :withdot="false" variant="{{ $page['status_color' ] }}">{{ $page['status'] }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $page['published_at'] }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-link href="{{ route('admin.pages.edit', $page['id']) }}">Edit</x-link>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <div class="mt-5">{{ $pages->links() }}</div>
        @else 
            <x-card-empty />
        @endif
    </x-section-centered>
</div>
