<x-app-layout title="Profile">
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="/dashboard">Go back</x-text-link>
            </x-slot>

            <x-slot:title>
                Profile
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card>
           

            <x-media>
                <x-slot name="mediaObject">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <x-image class="w-20 rounded-full overflow-hidden" :rounded="false" image="{{ $user->photo_url }}" image-aspect-ratio="1:1" />
                        </div>                        
                    </div>

                </x-slot>
                <x-slot name="mediaBody">
                    <x-heading>Hello, {{ $user->name ?? 'Hello User' }}</x-heading>
                    {{ $user->designation }}
                </x-slot>
            </x-media>

            <div class="text-right">
                <x-button type="button" color="white" class="text-tory-blue-600 font-semibold hover:opacity-75" tag="a"
                    href="{{ route('profile.edit') }}">
                    <x-icon-edit class="w-4 h-4 mr-1 -ml-1" />Edit Profile
                </x-button>
            </div>

            <x-description-list>
                <x-slot name="heading">Your profile information in JJM</x-slot>
                <x-slot name="subheading" class="mb-5">
                    Personal information and management options. Some information may be visible to others who use JJM.
                </x-slot>

                <x-description-list.item>
                    <x-slot name="title">Name</x-slot>
                    <x-slot name="description">{{ $user->name ?? '-' }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Phone</x-slot>
                    <x-slot name="description">{{ $user->phone ?? '-' }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Email</x-slot>
                    <x-slot name="description">{{ $user->email ?? '-' }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Gender</x-slot>
                    <x-slot name="description">
                        <span class="capitalize">
                            {{ $user->gender ?? '-' }}</x-slot>
                        </span>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Date of Birth</x-slot>
                    <x-slot name="description">{{ $user->dob?->format('d-m-Y') ?? '-' }}</x-slot>
                </x-description-list.item>

                {{-- <x-description-list.item>
                    <x-slot name="title">Address</x-slot>
                    <x-slot name="description">{{ $user->address ?? '-' }}</x-slot>
                </x-description-list.item> --}}

                <x-description-list.item>
                    <x-slot name="title">Office</x-slot>
                    <x-slot name="description">
                        {{ $user->office_names ?? 'JJM Assam' }}
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Role</x-slot>
                    <x-slot name="description">{{ Str::title($user->role) ?? '-' }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Designation</x-slot>
                    <x-slot name="description">{{ $user->designation ?? '-' }}</x-slot>
                </x-description-list.item>
            </x-description-list>
        </x-card>

        <x-section-border />

        <x-card>
            <x-media class="mb-4 items-center">
                <x-slot name="mediaObject">
                    <svg class="flex-shrink-0 w-10 h-10 mx-auto text-tory-blue-500" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.5 11.3V7.04001C20.5 3.01001 19.56 2 15.78 2H8.22C4.44 2 3.5 3.01001 3.5 7.04001V18.3C3.5 20.96 4.96001 21.59 6.73001 19.69L6.73999 19.68C7.55999 18.81 8.80999 18.88 9.51999 19.83L10.53 21.18"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M18.2 21.4C19.9673 21.4 21.4 19.9673 21.4 18.2C21.4 16.4327 19.9673 15 18.2 15C16.4327 15 15 16.4327 15 18.2C15 19.9673 16.4327 21.4 18.2 21.4Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 22L21 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path opacity="0.4" d="M8 7H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path opacity="0.4" d="M9 11H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </x-slot>
                <x-slot name="mediaBody">
                    <x-heading size="xl">Looking for something else?</x-heading>
                </x-slot>
            </x-media>

            <x-description-list>
                <x-description-list.item>
                    <x-slot name="description">
                        <x-text-link href="{{ route('profile.edit') }}#changepassword" class="font-medium">How to
                            change my current password?</x-text-link>
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="description">
                        <x-text-link href="{{ route('profile.edit') }}#loggedcheck" class="font-medium">Where else my
                            user ID is logged in?</x-text-link>
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="description">
                        <x-text-link href="{{ route('profile.activities') }}" class="font-medium">How to check my
                            recent activities done in INO?</x-text-link>
                    </x-slot>
                </x-description-list.item>
            </x-description-list>
        </x-card>
    </x-section-centered>
</x-app-layout>
