<div>
    <x-slot name="title">All Schools</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Schools
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('schools.create') }}" with-icon icon="add">New School</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-5">
            <livewire:schools.stats />
        </div>
        
        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-3">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="category" wire:model="category">
                    <option value="all">--Select Category--</option>
                    @foreach($this->schoolCategories as $schoolCategory)
                    <option value="{{ $schoolCategory->value }}">{{ $schoolCategory->name }}</option>
                    @endforeach
                </x-select>
                {{-- <x-select no-margin name="board" wire:model="board">
                    <option value="all">--Select Board--</option>
                    @foreach($this->schoolBoards as $schoolBoard)
                    <option value="{{ $schoolBoard->value }}">{{ $schoolBoard->name }}</option>
                    @endforeach
                </x-select> --}}
            </div>

            @if($schools->isNotEmpty())
                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>School Name</x-table.thead>
                            <x-table.thead>District/Block</x-table.thead>
                            <x-table.thead>Affiliated Board</x-table.thead>
                            <x-table.thead>School Category</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $school)
                            <tr>
                                <x-table.tdata>
                                    <div class="font-semibold text-slate-700">{{ $school->name }}</div>
                                    <div class="flex space-x-1 text-sm">
                                        <div class="text-slate-600">{{ $school->phone }}</div>
                                        <div class="text-slate-300">/</div>
                                        <div class="text-slate-600">{{ $school->email }}</div>
                                    </div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $school->district?->name }}/{{ $school->block?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $school->affiliated_board }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ Str::title($school->school_category) }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-show 
                                            href="#" 
                                            x-on:click.prevent="livewire.emitTo('schools.show', 'showSchoolDetailsSlideover', '{{ $school->id }}')" 
                                        />
                                        <x-button-icon-edit href="{{ route('schools.edit', $school->id) }}" />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        <div class="mt-5">{{ $schools->links() }}</div>
    </x-section-centered>
</div>

<livewire:schools.show />