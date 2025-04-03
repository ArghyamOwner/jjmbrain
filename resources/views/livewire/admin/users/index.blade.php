<div>
    <x-slot name="title">All Users</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Users
    </x-slot>

    @cannot('lab-ho')
    <x-slot name="action">
        <x-button tag="a" href="{{ route('admin.users.create') }}" with-icon icon="add">New user</x-button>
    </x-slot>
    @endcannot
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search..." />
                </div>

                @cannot('tpa-admin')
                @cannot('lab-ho')
                <x-select no-margin name="role" wire:model="role">
                    <option value="all">--Select a role--</option>
                    @foreach($this->roles as $roleKey => $roleName)
                    <option value="{{ $roleKey }}">{{ $roleName }}</option>
                    @endforeach
                </x-select>
                @endcannot

                <x-select no-margin name="division" wire:model="division">
                    <option value="all">--Select a division--</option>
                    @foreach($this->divisions as $divisionKey => $divisionName)
                    <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                    @endforeach
                </x-select>
                @endcannot
            </div>

            @if($users->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Email</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>Role</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            @unless (auth()->user()->isStateIsa())
                            <x-table.thead>Action</x-table.thead>
                            @endunless
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <x-table.tdata>
                                <div class="flex items-center">
                                    <div class="shrink-0 w-8 h-8 rounded-full bg-slate-100 mr-2">
                                        <img src="{{ $user->photo_url }}" alt="beneficiary_photo" loading="lazy"
                                            class="object-fit w-8 h-8 rounded-full">
                                    </div>
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                </div>
                                {{-- <x-text-link href="{{ route('admin.users.show', $user->id) }}"> --}}
                                    {{-- {{ $user->name }} --}}
                                    {{-- </x-text-link> --}}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $user->email }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $user->phone }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $user->role }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-badge variant="{{ $user->user_status_color }}">{{ $user->user_status }}</x-badge>
                            </x-table.tdata>
                            @unless (auth()->user()->isStateIsa())
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('admin.users.show', $user->id) }}" />
                                    <x-button-icon-edit href="{{ route('admin.users.edit', $user->id) }}" />
                                </div>
                            </x-table.tdata>
                            @endunless
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($users->hasPages())
        <div class="mt-5">{{ $users->links() }}</div>
        @endif
    </x-section-centered>
</div>