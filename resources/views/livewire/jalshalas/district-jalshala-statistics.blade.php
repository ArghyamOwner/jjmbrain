<div>
    <div class="flex">
        <div class="flex-1">
            <x-heading size="md">Jal Shala District Statistics</x-heading>
        </div>
        <x-button type="button" color="white" wire:click="generate" wire:target="generate" with-spinner>
            Download CSV
        </x-button>
    </div>
    @if ($districts->isNotEmpty())
        @if ($type === 'phase_I')
            <div class="my-3">
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead
                                class="sticky left-0 z-10 text-left whitespace-nowrap">District</x-table.thead>
                            <x-table.thead>Targeted</x-table.thead>
                            <x-table.thead>Conducted</x-table.thead>
                            <x-table.thead>Pending</x-table.thead>
                            <x-table.thead>PWSS Mapped</x-table.thead>
                            <x-table.thead>School Mapped</x-table.thead>
                            <x-table.thead>Jaldoot Mapped</x-table.thead>
                            <x-table.thead>Jaldoot Participated</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($districts as $data)
                            <tr>
                                <x-table.tdata
                                    class="md:w-1/5 sticky left-0 z-10 bg-white text-left whitespace-nowrap leading-none">
                                    <x-text-link
                                        href="{{ route('jalshalas.block-statistics', ['district' => $data->id, 'type' => request()->query('type')]) }}">
                                        {{ $data->name }}
                                    </x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->targeted_jalshala ?? 0 }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('conducted') }}
                                </x-table.tdata> 
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('pending') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('pwss_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('school_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('jaldoot_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIJalshalaStatics?->sum('jaldoot_participated') }}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        @endif

        @if ($type === 'phase_II')
            <div class="my-3">
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead
                                class="sticky left-0 z-10 text-left whitespace-nowrap">District</x-table.thead>
                            <x-table.thead>Targeted</x-table.thead>
                            <x-table.thead>Conducted</x-table.thead>
                            <x-table.thead>Pending</x-table.thead>
                            <x-table.thead>PWSS Mapped</x-table.thead>
                            <x-table.thead>School Mapped</x-table.thead>
                            <x-table.thead>Jaldoot Mapped</x-table.thead>
                            <x-table.thead>Jaldoot Participated</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($districts as $data)
                            <tr>
                                <x-table.tdata
                                    class="md:w-1/5 sticky left-0 z-10 bg-white text-left whitespace-nowrap leading-none">
                                    <x-text-link
                                        href="{{ route('jalshalas.block-statistics', ['district' => $data->id, 'type' => request()->query('type')]) }}">
                                        {{ $data->name }}
                                    </x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phase2_targeted_jalshala ?? 0 }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('conducted') }}
                                </x-table.tdata> 
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('pending') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('pwss_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('school_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('jaldoot_mapped') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $data->phaseIIJalshalaStatics?->sum('jaldoot_participated') }}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        @endif
    @else
        <x-card-empty />
    @endif
</div>
