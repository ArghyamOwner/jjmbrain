<div>
    <x-slot name="title">Notifications</x-slot>
  
    <x-section-centered>
        @forelse($notifications as $notification)
            <div class="mb-4">
                @can('super')
                    <x-card>
                        <x-media>
                            <x-slot name="mediaObject">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                                    <x-icon-notification class="text-blue-600 w-6 h-6"/>
                                </div>
                            </x-slot>
        
                            <x-slot name="mediaBody">
                                <div class="flex flex-wrap space-x-3 items-center mb-1">
                                    <div class="text-gray-500 text-sm">@date($notification->created_at)</div>
                                </div>
                        
                                <div class="text-gray-600 mb-4">
                                    {!! nl2br($notification->data['message']) !!}
                                </div>
                    
                                @if(count($notification->data['to']))
                                    <div class="text-gray-600">
                                        <span class="text-sm block mb-1">Message send to:</span>
                                        @foreach ($notification->data['to'] as $receiver)
                                            <x-badge class="mr-1">{{ $receiver }}</x-badge>
                                        @endforeach
                                    </div>
                                @endif
                            </x-slot>
                        </x-media>
                    </x-card>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <x-card>
                        <x-media>
                            <x-slot name="mediaObject">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                                    <x-icon-notification class="text-blue-600 w-6 h-6"/>
                                </div>
                            </x-slot>
        
                            <x-slot name="mediaBody">
                                <div class="flex flex-wrap space-x-3 items-center mb-1">
                                    <div class="text-gray-500 font-bold">From Admin</div>
                                    <div class="text-gray-500 text-sm">{{ $notification->created_at->shortRelativeToNowDiffForHumans() }}</div>
                                </div>
                        
                                <div class="text-gray-600">
                                    {!! nl2br($notification->data['message']) !!}
                                </div>
                            </x-slot>
                        </x-media>
                    </x-card>
                @endcan
            </div>
        @empty
            <x-empty>No new notifications available.</x-empty>
        @endforelse
    </x-section-centered>
</div>
