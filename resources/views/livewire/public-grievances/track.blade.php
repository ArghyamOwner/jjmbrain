<div>
    <div class="bg-cover bg-no-repeat min-h-screen pb-10"
        style="background-image: url('{{ url('img/background-grievance.svg') }}')">
        <x-section-centered class="pt-6 pb-12">

            <div class="px-14">

                <div class="mb-4">
                    <!-- Logo -->
                    <a href="#" aria-label="Home" class="flex items-center shrink-0">
                        <img class="h-16 md:h-20 object-contain" src="{{ url('img/jjm-logo.png') }}" alt="jjm-Logo"
                            loading="lazy">
                        <div class="font-bold md:text-3xl text-sky-500">
                            Jal Jeevan Mission
                        </div>
                    </a>
                    <!-- ./Logo -->
                </div>

                <x-section-container-styled heading="Track Your Grievance">
                    <div>
                        <form wire:submit.prevent="checkStatus">
                            <div class="flex space-x-3">
                                <div class="flex-1">
                                    <x-input-search no-margin name="search" wire:model.defer="search" class="w-full"
                                        placeholder="Reference Number / Phone Number" />
                                </div>
                                <x-button color="white" class="text-sky-700" with-spinner>Track status</x-button>
                            </div>
                        </form>
                        <x-text-link href="{{ route('grievance.apply') }}" color="white" class="mt-3"><x-icon-add
                                class="w-5 h-5" />Submit new Grievance</x-text-link>
                    </div>
                </x-section-container-styled>

                @if ($application)
                    <div class="flex-1 w-full overflow-x-hidden overflow-y-auto pb-8 pt-6">
                        {{-- <x-card overflow-hidden form-action="checkStatus">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <x-label for="search">Ticket Number / Phone Number</x-label>
                                <x-input placeholder="Please enter the Reference Number / Phone Number" id="search"
                                    type="text" wire:model.defer="search" class="mt-1 w-full md:w-full"
                                    autocomplete="off" />
                                <x-input-error for="search" class="mt-1" />
                            </div>

                            <x-slot name="footer" class="text-center">
                                <x-button withSpinner color="blue" class="w-2/4" wire:loading.attr="disabled"
                                    wire:target="checkStatus" wire:loading.class="base-spinner">
                                    Track Status
                                </x-button>
                            </x-slot>
                        </x-card> --}}
                        <x-card no-padding overflow-hidden card-classes="pb-4">
                            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                                <thead>
                                    <tr>
                                        <x-table.thead>Date / Ref No</x-table.thead>
                                        <x-table.thead>Scheme</x-table.thead>
                                        <x-table.thead>Category</x-table.thead>
                                        <x-table.thead>Sub-category</x-table.thead>
                                        <x-table.thead>Status</x-table.thead>
                                        <x-table.thead>Action</x-table.thead>
                                    </tr>
                                </thead>
                                @foreach ($application as $data)
                                    <tbody>
                                        <tr>
                                            <x-table.tdata>
                                                {{ $data->created_at?->format('d-M-Y') }}
                                                <p class="text-xs font-bold text-sky-700">{{ $data->reference_no }}</p>
                                            </x-table.tdata>
                                            <x-table.tdata>
                                                {{ $data?->scheme?->name }}
                                            </x-table.tdata>
                                            <x-table.tdata>
                                                {{ $data->category?->name }}
                                            </x-table.tdata>
                                            <x-table.tdata>
                                                {{ $data->subCategory?->name }}
                                            </x-table.tdata>
                                            <x-table.tdata>
                                                <x-badge
                                                    variant="{{ $data->status_color }}">{{ $data->status }}</x-badge>
                                            </x-table.tdata>
                                            <x-table.tdata>
                                                <x-button color="blue" tag="a" href="#" x-data
                                                    class="w-30"
                                                    x-on:click.prevent="Livewire.emit('showAssignSlideover', '{{ $data->id }}')"
                                                    x-cloak>
                                                    View
                                                </x-button>
                                            </x-table.tdata>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </x-table.table>
                        </x-card>
                    </div>
                @endif
            </div>
        </x-section-centered>
    </div>
</div>

<livewire:public-grievances.show-assign />
