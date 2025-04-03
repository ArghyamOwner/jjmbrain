<div>
    <x-slot name="title">All Backups</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top>
            <x-slot:beforeTitle>
                <x-breadcrumb class="text-lg">
                    <x-breadcrumb-item>Backups</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>
        </x-navbar-top>
    </x-slot>
    @once
        @push('alpinejs-scripts')
            <script defer src="https://unpkg.com/@alpinejs/collapse@3.9.0/dist/cdn.min.js"></script>
        @endpush
    @endonce

    <x-section-centered>
        @if ($directories)
            <x-card no-padding>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Link</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($directories as $directory)
                            <tr>
                                <x-table.tdata>
                                    {{ Str::title($directory) }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-text-link
                                        href="https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/backups/{{ $directory }}">Download</x-text-link>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>
        @else
            <x-card-empty />
        @endif

    </x-section-centered>
</div>
