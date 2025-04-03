<div>
    <div class="mt-6 mb-6">
        <x-heading size="md" class="mb-1">Pipe Network Summary</x-heading>
        @if($summary)
        <x-table.table>
            <thead>
                <tr>
                    <x-table.thead>Color</x-table.thead>
                    <x-table.thead>Size</x-table.thead>
                    <x-table.thead>Distance</x-table.thead>
                </tr>
            </thead>
            <tbody>
                @foreach ($summary as $canal)
                <tr>
                    <x-table.tdata>
                        <div style="background-color:{!! $canal->color_code !!} " class="w-2.5 h-2.5 rounded-full border border-black">
                        </div>
                    </x-table.tdata>
                    <x-table.tdata>
                            {{ $canal->size }} mm
                    </x-table.tdata>
                    <x-table.tdata>{{ $canal->total_distance }} km</x-table.tdata>
                </tr>
                @endforeach
                <tr class="text-red-600 font-bold">
                    <x-table.tdata class="border-t-red-200">TOTAL</x-table.tdata>
                    <x-table.tdata class="border-t-red-200"></x-table.tdata>
                    <x-table.tdata class="border-t-red-200">{{ $total }} KM</x-table.tdata>
                </tr>
            </tbody>
        </x-table.table>
        @else
        <x-card-empty />
        @endif
    </div>
</div>