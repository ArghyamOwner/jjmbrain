<div>
    <x-slot name="title">Survey Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('outbound') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Survey Details
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card card-classes="mb-8">
                <x-description-list size="xs">
                    {{-- <x-description-list.item>
                        <x-slot name="title">Division Name</x-slot>
                        <x-slot name="description">
                            {{ $survey->beneficiary->scheme?->division?->name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Scheme Name</x-slot>
                        <x-slot name="description">
                            {{ $survey->beneficiary->scheme?->name }}
                        </x-slot>
                    </x-description-list.item> --}}

                    <x-description-list.item>
                        <x-slot name="title">Name</x-slot>
                        <x-slot name="description">
                            {{ $survey->user->name }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Email</x-slot>
                        <x-slot name="description">
                            {{ $survey->user->email }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Phone</x-slot>
                        <x-slot name="description">
                            {{ $survey->user->phone }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Role</x-slot>
                        <x-slot name="description">
                            {{ $survey->user->role }}
                        </x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>

            <x-heading class="mb-4">Questions</x-heading>

            @foreach($survey->answer as $key => $value)
            <x-card card-classes="mt-2">
                <div class="flex items-center">
                    <div class="flex-1">
                        <x-heading size="md">{{ $key }}</x-heading>
                    </div>
                    <div>
                        <div class="flex space-x-1">
                            <x-heading size="md">{{ $value }}</x-heading>
                        </div>
                    </div>
                </div>
            </x-card>
            @endforeach
        </x-section-centered>
</div>