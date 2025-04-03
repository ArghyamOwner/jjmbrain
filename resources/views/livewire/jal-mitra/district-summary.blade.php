<div>
    <div class="flex mt-6">
        <div class="flex-1">
            <x-heading size="md">District Summary</x-heading>
        </div>
    </div>
    @if (count($summary))
        <div class="my-3">
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead class="sticky left-0 z-10 text-left whitespace-nowrap">District</x-table.thead>
                        @foreach ($summary[0] as $key => $value)
                        @if($key == 'District' || $key == 'id')
                        @continue
                        @endif
                        <x-table.thead>{{ Str::headline($key) }}</x-table.thead>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @foreach ($summary as $data)
                        <tr>
                            <x-table.tdata
                                class="md:w-1/5 sticky left-0 z-10 bg-white text-left whitespace-nowrap leading-none">
                                <x-text-link href="#">
                                    {{ $data['District'] }}
                                </x-text-link>
                            </x-table.tdata>
                            @foreach ($data as $dataKey => $dataValue)
                            @if($dataKey == 'District' || $dataKey == 'id')
                                @continue
                            @endif
                            <x-table.tdata>
                                {{ $dataValue }}
                            </x-table.tdata>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
    @else
        <x-card-empty />
    @endif
</div>

