<div>
    <x-slot name="title">Campaigns</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Campaigns
    </x-slot>
    <x-slot name="action">
        <x-button tag="a" href="{{ route('campaigns.create') }}" with-icon icon="add">New Campaign</x-button>
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($campaigns->isNotEmpty())
                <x-table.table :rounded="false">

                    <thead>
                        <tr>
                            <x-table.thead>Campaign Name</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($campaigns as $campaign)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('campaigns.show', $campaign->id) }}">
                                        {{ $campaign->name }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {!! $campaign->status_name !!}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>
        @if ($campaigns->hasPages())
            <div class="mt-5">{{ $campaigns->links() }}</div>
        @endif
    </x-section-centered>
</div>
