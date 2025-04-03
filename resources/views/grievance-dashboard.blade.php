<x-app-layout title="Grievance Management">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Grievance Management
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <livewire:grievances.chart />

        @if ((auth()->user()->role == 'admin') || (auth()->user()->role == 'call-center'))
        <livewire:logs.cards />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('grievancesInbound.create') }}"
                        class="items-center hover:underline text-indigo-600 hover:text-indigo-700">
                        <div class="bg-white shadow-sm border rounded-md h-20 p-5">
                            <div class="h-4 rounded-md text-center text-lg">INBOUND</div>
                        </div>
                    </a>
                    <a href="{{ route('outbound') }}"
                        class="items-center hover:underline text-indigo-600 hover:text-indigo-700">
                        <div class="bg-white shadow-sm border rounded-md h-20 p-5">
                            <div class="h-4 rounded-md text-center text-lg">OUTBOUND</div>
                        </div>
                    </a>
                    {{-- <a href="{{ route('grievances') }}"
                        class="items-center hover:underline text-indigo-600 hover:text-indigo-700">
                        <div class="bg-white shadow-sm border rounded-md h-20 p-5">
                            <div class="h-4 rounded-md text-center mb-2">ALL GRIEVANCES</div>
                        </div>
                    </a> --}}
                    <a href="{{ route('logs') }}"
                        class="items-center hover:underline text-indigo-600 hover:text-indigo-700">
                        <div class="bg-white shadow-sm border rounded-md h-20 p-5">
                            <div class="h-4 rounded-md text-center mb-2">LOGS</div>
                        </div>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-5 mb-3">
                    <x-button color="indigo" class="w-full" tag="a"
                        href="{{ route('grievances', ['status'=>'pending', 'sort' => 'asc']) }}">View Pending Grievances
                    </x-button>
                    <x-button color="indigo" class="w-full" tag="a"
                        href="{{ route('grievances', ['status'=>'resolved']) }}">View Resolved Grievances
                    </x-button>
                    <x-button color="indigo" class="w-full" tag="a" href="{{ route('contractorGrievances') }}">
                        Contractor Grievances
                    </x-button>
                    <x-button color="indigo" class="w-full" tag="a" href="{{ route('grievances') }}">
                        View All Grievances
                    </x-button>
                </div>
                {{-- <div>
                    <x-button color="indigo" class="w-full" tag="a" href="{{ route('grievances') }}">View All Grievances
                    </x-button>
                </div> --}}
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <livewire:grievances.top-schemes />
            <livewire:grievances.actors-not-working />
        </div>
    </x-section-centered>
</x-app-layout>