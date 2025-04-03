<div>
    <x-slot name="title">Role Based Report</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Role-Based Report
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        @if($this->roles->isNotEmpty())
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->roles as $role)
                        <tr>
                            <x-table.tdata>{{ $role->title }}</x-table.tdata>
                            <x-table.tdata>
                                <x-button type='button' color="white" wire:click="download('{{ $role->file }}')" 
                                    wire:target="download('{{ $role->file }}')" with-spinner>Download</x-button>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </x-card>
        @else
        <x-card-empty class="shadow-none rounded-none" />
        @endif

        {{-- @if($this->roles)
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Role</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->roles as $key => $value)
                        <tr>
                            <x-table.tdata>{{ $value }}</x-table.tdata>
                            <x-table.tdata>
                                <a href="{{route('roleBased.download', $key)}}" 
                                class="font-medium text-indigo-600 hover:underline">Generate</a>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        </x-card>
        @else
        <x-card-empty class="shadow-none rounded-none" />
        @endif --}}
    </x-section-centered>
</div>