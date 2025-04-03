<div>
    @if ($activities->isNotEmpty())
        <x-card>
            @foreach ($activities as $activity)
                <x-timeline :last="$loop->last">
                    <x-slot:customIcon>
                        <div class="h-10 w-10 bg-indigo-50 rounded-full flex items-center justify-center">
                        <img src="{{ $activity?->user?->photo_url }}" alt="user" class="w-10 h-10 rounded-full object-fit" loading="lazy">
                        </div>
                    </x-slot>
                    
                    <div class="text-sm text-slate-700 mb-1">
                        @include('partials.schemes.' . $activity->activity_type)
                    </div>
                    <p class="text-xs text-slate-500">{{ $activity->created_at?->diffForHumans(null, false, true) }}</p>
                </x-timeline>
            @endforeach
        </x-card>
        @if ($activities->hasPages())
        <div class="mt-5">{{ $activities->links() }}</div>
        @endif
    @else
        <x-card-empty />
    @endif
</div>
