<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Stock Consume</x-slot>

        <div class="py-3 px-6">
            <form wire:submit.prevent="save">

                <x-input-number label="Consumed Quantity" name="quantity" wire:model.defer="quantity" />
                <x-button with-spinner wire:target="save" class="w-full">Save</x-button>
            </form>
        </div>

        <div class="mt-8 border-t py-6 px-6">
            @if ($consumes->isNotEmpty())
            <x-heading size="md">Consumption Details</x-heading>
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Date</x-table.thead>
                            <x-table.thead>Consumed Quantity</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consumes as $consume)
                            <tr>
                                <x-table.tdata>
                                    @date($consume->created_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $consume->quantity }}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @endif
        </div>
    </x-slideovers>
</div>
