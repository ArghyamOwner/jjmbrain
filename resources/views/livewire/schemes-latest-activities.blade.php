<div>
    <div wire:init="getActivities">
        <x-heading size="md" class="mb-1">Latest activities</x-heading>
        @if ($activities)
            <x-card>
                @foreach ($activities as $activity)
                    <x-timeline :last="$loop->last">
                        <x-slot:customIcon>
                            <div class="h-10 w-10 bg-indigo-50 rounded-full flex items-center justify-center">
                            <img src="{{ $activity->user?->photo_url ?? 'https://api.dicebear.com/7.x/initials/svg/seed=smt' }}" alt="user" class="w-10 h-10 rounded-full object-fit" loading="lazy">
                            </div>
                        </x-slot>
                        
                        <div class="text-sm text-slate-700 mb-1 whitespace-normal">
                            @include('partials.schemes.' . $activity->activity_type)
                        </div>
                        <div class="flex space-x-2 items-center">
                            <p class="text-sm text-slate-500">{{ $activity->created_at?->diffForHumans(null, false, true) }}</p>
                            <span class="text-xs text-slate-400">&bull;</span>
                            <x-text-link class="text-sm" href="{{ $activity->url() ?? '' }}">View</x-text-link>
                        </div>

                    </x-timeline>
                @endforeach
            </x-card>
        @else
            <x-card-empty />
        @endif
    </div>
</div>
