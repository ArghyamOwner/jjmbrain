<x-app-layout title="Jal Shala Dashboard">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Jal Shala Dashboard
            </x-slot>

            {{-- <x-slot:action>
                <x-button with-icon icon="list" tag="a" color="indigo" href="{{ route('jalshalas.district-statistics') }}">District Wise View</x-button>
            </x-slot> --}}
            
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @livewire('jalshalas.statistics', ['type' => request()->query('type')])
        @can('district-jaldoot-cell')
            @livewire('jalshalas.education-block-jalshala-statistics', ['district' => auth()->user()->districts->first()['id'], 'type' => request()->query('type')])
        @endcan
    </x-section-centered>


    @push('scripts-footer')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
        <script>
            Chart.defaults.font.size = 12;
            Chart.defaults.font.family = 'Inter';
            Chart.defaults.borderColor = '#f1f5f9';
            Chart.defaults.plugins.tooltip.usePointStyle = true;
            Chart.defaults.plugins.tooltip.boxPadding = 4;
            Chart.defaults.plugins.tooltip.boxWidth = 8;
            Chart.defaults.plugins.tooltip.boxHeight = 8;
            Chart.defaults.plugins.tooltip.caretSize = 0;
        </script>
    @endpush
</x-app-layout>
