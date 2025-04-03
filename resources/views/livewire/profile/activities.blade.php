<div>
    <x-slot name="title">Activities</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('profile') }}">Go Back</x-text-link>
    </x-slot>
    <x-slot:title>
        Recent Activities
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card>
                <x-media class="mb-4 items-center">
                    <x-slot name="mediaObject">
                        <svg class="flex-shrink-0 w-10 h-10 mx-auto text-tory-blue-500" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M12.3691 8.87988H17.6191" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M6.38086 8.87988L7.13086 9.62988L9.38086 7.37988"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path opacity="0.4" d="M12.3691 15.8799H17.6191" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M6.38086 15.8799L7.13086 16.6299L9.38086 14.3799"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </x-slot>
                    <x-slot name="mediaBody">
                        <x-heading size="xl">Things that you have done and updated in JJM so far</x-heading>
                        <p class="text-sm">Discover, re-discover things that you have done, updated, created,
                            reported and helped the organisation since you joined JJM portal.</p>
                    </x-slot>
                </x-media>

                <div class="mt-6">
                    @if ($activities->isNotEmpty())
                    @foreach ($activities as $key => $activity)
                    <x-timeline :last="$loop->last">
                        <x-slot name="customIcon">
                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tory-blue-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </x-slot>

                        <x-slot name="subtitle">{{ $activity->created_at?->format('M d, Y h:i A') }}</x-slot>

                        <div class="text-sm text-slate-700 mb-1 whitespace-normal">
                            @include('partials.schemes.' . $activity->activity_type)
                        </div>
                        <div class="flex space-x-2 items-center">
                            <x-text-link class="text-sm" href="{{ $activity->url() ?? '' }}">View</x-text-link>
                        </div>

                    </x-timeline>
                    @endforeach
                    @else
                    <x-card-empty class="shadow-none" />
                    @endif
                </div>
            </x-card>
        </x-section-centered>
</div>