<div>
    <x-slot name="title">{{ $user->name }}</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            @unless (auth()->user()->isTechSupport())
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('admin.users') }}">Go Back</x-text-link>
            </x-slot>
            @endunless
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="grid md:grid-cols-2 gap-6 mb-6">

            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-4">
                        <div>
                            <x-heading size="lg">Basic Details</x-heading>
                        </div>
                        <div class="text-right col-span-3">
                            @if($user->blocked_at !== null)
                            {{-- <x-badge variant="danger">Blocked ({{ $user->blocked_at?->diffForHumans() ?? '-' }})</x-badge> --}}
                            <x-badge variant="danger">Blocked by {{ ($user->blockedBy?->name ?? 'N/A').' ('.($user->blocked_at?->diffForHumans() ?? '-').')'}}</x-badge>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Name:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->name }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Phone:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->phone ?? '-' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Email:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->email ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-2">
                        <div>
                            <x-heading size="lg">Document Details</x-heading>
                        </div>
                        @if (!$user->joining_document_url)
                        <div class="text-right">
                            <x-button color="white" tag="a" href="#" x-data class="w-30 text-blue-500"
                                x-on:click.prevent="$dispatch('show-modal', 'save')" x-cloak>
                                Update Document
                            </x-button>
                        </div>
                        @else
                        <div class="text-right">
                            <x-button tag="a" color="blue" href="{{ $user->joining_document_url }}" with-icon
                                icon="download" target="_blank">Download</x-button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="p-4">
                    <div class="divide-y divide-gray-100">
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Designation:
                            </div>
                            <p class="text-slate-900 text-sm uppercase">
                                {{ $user->designation ?? '-' }}
                            </p>
                        </div>
                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Role:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->role ? Str::title($user->role) : '-' }}
                            </p>
                        </div>

                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Date of joining:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->doj?->format('j M, Y') ?? '-' }}
                            </p>
                        </div>

                        <div class="py-2 px-2 grid grid-cols-2">
                            <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Last Login Date:
                            </div>
                            <p class="text-slate-900 text-sm">
                                {{ $user->last_app_login?->format('j M, Y') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if ($user->role === 'jal-mitra' && $salaries->isNotEmpty())
            <div class="bg-white rounded-md shadow">
                <div class="px-4 py-2 border-b border-gray-200">
                    <div class="grid grid-cols-2">
                        <div>
                            <x-heading size="lg">Salary Received</x-heading>
                        </div>
                    </div>
                </div>
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Year</x-table.thead>
                                <x-table.thead>Month</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaries as $salary)
                            <tr>
                                <x-table.tdata>
                                    {{ $salary->year }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $salary->month_name }}
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            </div>
            @endif
        </div>

        <div class="bg-white rounded-md shadow mb-6">
            <div class="px-4 py-2 border-b border-gray-200">
                <div class="grid grid-cols-1">
                    <div>
                        <x-heading size="lg">Administrative Details</x-heading>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="divide-y divide-gray-100">
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">District(s):
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->district_names ?? '-' }}
                        </p>
                    </div>
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Division(s):
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->division_names ?? '-' }}
                        </p>
                    </div>
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Sub-Division(s):
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->subdivision_names ?? '-' }}
                        </p>
                    </div>
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Block(s):
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->block_names ?? '-' }}
                        </p>
                    </div>
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Panchayat:
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->panchayat?->panchayat_name ?? '-' }}
                        </p>
                    </div>
                    <div class="py-2 px-2 grid grid-cols-2">
                        <div class="text-slate-500 text-xs uppercase tracking-wider font-medium">Office(s):
                        </div>
                        <p class="text-slate-900 text-sm">
                            {{ $user->office_names ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdministrator())
        <div class="bg-white rounded-md shadow">
            <div class="px-4 py-2 border-b border-gray-200">
                <div class="grid grid-cols-2">
                    <div>
                        <x-heading size="lg">Block User</x-heading>
                    </div>
                    <div class="text-right space-x-4">
                        @if($user->blocked_at !== null)
                            <x-badge variant="danger">Blocked by {{ ($user->blockedBy?->name ?? 'N/A').' ('.($user->blocked_at?->diffForHumans() ?? '-').')'}}</x-badge>
                            <x-button color="cyan" tag="a" href="#" with-icon icon="check-circle" x-data="{}"
                                x-on:click.prevent="$dispatch('show-modal', 'unblock-user-form')" x-cloak>Unblock User
                            </x-button>
                        @else
                        <x-button color="red" tag="a" href="#" with-icon icon="xclose" x-data="{}"
                            x-on:click.prevent="$dispatch('show-modal', 'block-user-form')" x-cloak>Block User
                        </x-button>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 mt-4">
                    <div>
                        <x-heading size="lg">Reset Password</x-heading>
                    </div>
                    <div class="text-right">
                        <x-button color="red" tag="a" href="#" with-icon icon="refresh" x-data="{}"
                            x-on:click.prevent="$dispatch('show-modal', 'jalmitra-edit-form')" x-cloak>Reset Password
                        </x-button>
                    </div>
                </div>
                
            </div>
        </div>
        @endif

        @can('lab-ho')
        <div class="mt-5">
            <livewire:labs.assign-user :user="$user->id" />
        </div>
        @endcan

        <x-modal-simple max-width="lg" form-action="update" name="save">
            <x-slot name="title">Upload document</x-slot>
            <x-filepond label="Joining Document" name="document" wire:model.defer="document"
                accept-files="application/pdf" hint="Maximum file size: 2 MB. Allowed file type: PDF" />

            <x-slot name="footer">
                <x-button color="black" type="submit" wire:target="update" with-spinner>Save</x-button>
            </x-slot>
        </x-modal-simple>
    </x-section-centered>

    <x-modal-simple max-width="lg" name="jalmitra-edit-form" form-action="resetPassword">
        <x-slot name="title">Reset Password</x-slot>
        Are you sure you want to reset the password to default ?
        <x-slot name="footer">
            <x-button color="red" type="submit" with-spinner wire:target="resetPassword">Reset</x-button>
        </x-slot>
    </x-modal-simple>

    <x-modal-simple max-width="lg" name="block-user-form" form-action="blockUser">
        <x-slot name="title">Block User</x-slot>
        Are you sure you want to Block this user ?
        <x-slot name="footer">
            <x-button color="red" type="submit" with-spinner wire:target="blockUser">Block</x-button>
        </x-slot>
    </x-modal-simple>

    <x-modal-simple max-width="lg" name="unblock-user-form" form-action="unblockUser">
        <x-slot name="title">Unblock User</x-slot>
        Are you sure you want to Unblock this user ?
        <x-slot name="footer">
            <x-button color="cyan" type="submit" with-spinner wire:target="unblockUser">Unblock</x-button>
        </x-slot>
    </x-modal-simple>
</div>