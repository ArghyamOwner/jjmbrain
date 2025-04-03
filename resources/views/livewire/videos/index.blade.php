<div>
    <x-slot name="title">All users</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Videos
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="#" with-icon icon="add">New Video</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if($videos->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Class</x-table.thead>
                            <x-table.thead>Subject</x-table.thead>
                            <x-table.thead></x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <x-table.tdata>
                                    <x-media>
                                        <x-slot name="mediaObject">
                                            <div class="rounded w-64 h-40 bg-slate-100">
                                                <img src="{{ $video->video_image_url }}" alt="video" class="rounded object-fit h-40" loading="lazy">
                                            </div>
                                        </x-slot>
                                        <x-slot name="mediaBody">
                                            {{ Str::title($video->video_title) }}
                                            <p class="text-slate-500 text-sm leading-none">{{ $video->video_description }}</p>
                                        </x-slot>
                                    </x-media>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $video?->class?->class_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $video?->subject?->subject_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                     
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </x-card>

            <div class="mt-5">{{ $videos->links() }}</div>
        @else 
            <x-card-empty />
        @endif
    </x-section-centered>
</div>
