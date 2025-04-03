<div>
    @if ($jalmitraUser)
    <x-card>
        <x-description-list size="xs" class="mb-6">
            <x-slot name="heading">Jal Mitra User Details</x-slot>

            <x-description-list.item>
                <x-slot name="title">Name</x-slot>
                <x-slot name="description">{{ $jalmitraUser->name }}</x-slot>
            </x-description-list.item>

            <x-description-list.item>
                <x-slot name="title">Email</x-slot>
                <x-slot name="description">{{ $jalmitraUser->email }}</x-slot>
            </x-description-list.item>

            <x-description-list.item>
                <x-slot name="title">Phone</x-slot>
                <x-slot name="description">{{ $jalmitraUser->phone }}</x-slot>
            </x-description-list.item>

            <x-description-list.item>
                <x-slot name="title">Date of Engagement</x-slot>
                <x-slot name="description">{{ $jalmitraUser->doj?->format('j M, Y') ?? '-' }}</x-slot>
            </x-description-list.item>

            <x-description-list.item>
                <x-slot name="title">Joining Document</x-slot>
                <x-slot name="description">
                    @if($jalmitraUser->joining_document_url)
                    <x-button tag="a" target="_blank" href="{{ $jalmitraUser->joining_document_url }}" color="white"
                        with-icon icon="download">Joining Document
                    </x-button>
                    @else
                    -
                    @endif
                </x-slot>
            </x-description-list.item>
        </x-description-list>

        <div class="flex space-x-2">
            <x-button tag="a" href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                        'schemes.jalmitra-user-delete',
                        'showDeleteModal',
                        '{{ $schemeId }}',
                        'Confirm Deletion',
                        'Are you sure you want to remove this Jal Mitra User from this scheme?',
                        '{{ $jalmitraUser->name }}'
                    )" with-icon icon="trash" color="white" class="text-red-600">Remove User</x-button>
            @if($jalmitraUser->joining_document)
            <x-button tag="a" href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                        'schemes.remove-jalmitra-document',
                        'showDeleteModal',
                        '{{ $jalmitraUser->id }}',
                        'Confirm Deletion',
                        'Are you sure you want to remove the Joining Document?',
                        '{{ $jalmitraUser->name }}'
                    )" with-icon icon="trash" color="white" class="text-red-600">Remove Document</x-button>
            @endif
            <livewire:schemes.edit-jalmitra :jalmitra="$jalmitraUser" />

        </div>
    </x-card>

    <livewire:schemes.jalmitra-user-delete />
    <livewire:schemes.remove-jalmitra-document />
    @else
    @unless (auth()->user()->isDc())
    <x-card-empty variant="">
        <p class="text-center text-slate-500 mb-3 text-sm">No Jalmitra user found.</p>
        <div class="flex space-x-2">
            <x-button tag="a" href="#" x-data="" x-on:click.prevent="$dispatch('show-modal', 'addJalmitraForm')"
                with-icon icon="add">Add Jalmitra User</x-button>
            <x-button tag="a" href="#" x-data="" x-on:click.prevent="$dispatch('show-modal', 'updateExistingJm')"
                with-icon icon="edit">Update Existing Jalmitra User</x-button>
        </div>
    </x-card-empty>
    @endunless

    <x-modal-simple max-width="xl" name="addJalmitraForm" form-action="save">
        <x-slot:title>Add a Jalmitra User</x-slot>

            <x-input label="Name" name="name" wire:model.defer="name" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone" name="phone"
                    wire:model.defer="phone" placeholder="eg. 7896XXXXXX" />

                <x-input type="date" label="Date of Engagement" name="doj" wire:model.defer="doj" />
            </div>

            <x-filepond optional accept-files="application/pdf" label="Upload Joinig document" name="joining_document"
                wire:model.defer="joining_document" />

            {{--
            <x-input label="Email" type="email" name="email" wire:model.defer="email" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-input type="password" label="Password" name="password" wire:model.defer="password" />
                <x-input type="password" label="Confirm Password" name="password_confirmation"
                    wire:model.defer="password_confirmation" />
            </div> --}}

            <x-slot:footer>
                <x-button with-spinner wire:target="save">Save</x-button>
                </x-slot>
    </x-modal-simple>

    <x-modal-simple max-width="xl" name="updateExistingJm" form-action="updateExistingUser">
        <x-slot:title>Add a Jalmitra User</x-slot>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-virtual-select label="Jal-Mitras" name="existingUserId" wire:model.defer="existingUserId" :options="[
                'options' => $this->jalmitras,
            ]" />

                <x-input type="date" label="Date of Engagement" name="doj" wire:model.defer="doj" />
            </div>

            <x-filepond accept-files="application/pdf" label="Upload Joinig document" name="joining_document"
                wire:model.defer="joining_document" />

            <x-slot:footer>
                <x-button with-spinner wire:target="updateExistingUser">Update</x-button>
                </x-slot>
    </x-modal-simple>
    @endif
</div>