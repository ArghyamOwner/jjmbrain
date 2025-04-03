<div>
    @if ($notices->isNotEmpty())
        <div class="flex justify-between items-center space-x-2 mb-1">
            <x-heading size="md">Latest Notices</x-heading>
            <div class="px-4">
                <x-text-link href="{{ route('notices') }}" class="text-sm">View all</x-text-link>
            </div>
        </div>

        <x-card no-padding overflow-hidden>
            <div>
                <x-table.table :rounded="true" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>Created At</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notices as $notice)
                            <tr>
                                <x-table.tdata>
                                    <x-badge variant="{{ $notice->type_color }}">{{ $notice->type?->name }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('notices.show', $notice->id) }}" target="_blank"
                                        class="font-medium">
                                        {{ $notice->title }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    @date($notice->created_at)
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </x-card>
    @endif
</div>
