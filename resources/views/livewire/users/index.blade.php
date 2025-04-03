<div>
    <x-slot name="title">All users</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Users
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('users.create') }}" with-icon icon="add">New User</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
    
        @if($users->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <div class="p-3 border-b">
                    <x-input-search 
                        no-margin 
                        name="search" 
                        wire:model.debounce.500ms="search" 
                        placeholder="Search..." 
                    />
                </div>

                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>School</x-table.thead>
                            <x-table.thead>Created at</x-table.thead>
                            <x-table.thead>Last Online</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <x-table.tdata>
                                    <x-media>
                                        <x-slot name="mediaObject">
                                            <div class="rounded w-10 h-10 bg-slate-100">
                                                <img src="{{ $user->photo_url }}" alt="avatar" class="rounded object-fit h-10" loading="lazy">
                                            </div>
                                        </x-slot>
                                        <x-slot name="mediaBody">
                                            {{ Str::title($user->name) }}
                                            <p class="text-slate-500 text-sm leading-none">{{ $user->email }}</p>
                                        </x-slot>
                                    </x-media>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $user?->school?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @date($user->created_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    @date($user->last_online_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    <livewire:users.deactivate wire:key="user-{{ $user->id }}" :user-id="$user->id" />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <div class="mt-5">{{ $users->links() }}</div>
        @else 
            <x-card-empty />
        @endif
    </x-section-centered>
</div>
