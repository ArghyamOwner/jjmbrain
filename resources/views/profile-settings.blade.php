<x-app-layout title="Settings">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{route('profile')}}">Go back</x-text-link>
    </x-slot>

    <x-slot:title>
        Settings
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <div class="mb-10">
                <livewire:profile-update />
            </div>

            <div id="changepassword" class="mb-10">
                <livewire:password-update />
            </div>

            <div id="loggedcheck" class="mb-6">
                <livewire:logout-other-browser-sessions-form />
            </div>
        </x-section-centered>
</x-app-layout>