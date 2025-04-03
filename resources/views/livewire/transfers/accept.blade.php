<div>
    <x-slot name="title">Accept Stock Transfers</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('transfers') }}">Go back to transfers</x-text-link>
            </x-slot>

            <x-slot:title>
                Accept Stock Transfers
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden>
            <x-heading class="mb-2" size="xl">
                <span class="text-slate-400">From:</span> {{ $sourceLabName }}
                &rarr;
                <span class="text-slate-400">To:</span> {{ $destinationLabName }}
            </x-heading>

            <x-description-list size="xs">
                <x-description-list.item>
                    <x-slot:title>Transfer Requested By</x-slot>
                    <x-slot:description>
                        {{ $transferRequestedBy }}
                    </x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot:title>Requested On</x-slot>
                    <x-slot:description>
                        {{ $transferRequestedDate }}
                    </x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot:title>Item Name</x-slot>
                    <x-slot:description>
                        {{ $itemName }}
                    </x-slot>
                </x-description-list.item>
                <x-description-list.item>
                    <x-slot:title>Quantity</x-slot>
                    <x-slot:description>
                        {{ $quantity }}
                    </x-slot>
                </x-description-list.item>
            </x-description-list>
            
            <x-slot name="footer" class="text-right">
                <x-button type="button" with-spinner wire:target="acceptTransfer" wire:click.prevent="acceptTransfer">Accept Stock Transfer</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>