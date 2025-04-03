<div>
    <x-slot name="title">Changelogs</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Changelogs
            </x-slot>

            <x-slot name="action">
                @can('admin')
                <x-button tag="a" href="{{ route('changelogs.create') }}" with-icon icon="add">New Changelog</x-button>    
                @endcan
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($changelogs->isNotEmpty())
            <x-card>
                @foreach ($changelogs as $key => $changelog)
                    <x-timeline :last="$loop->last">
                        <x-slot name="customIcon">
                            <div class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center leading-none {{ $loop->first ? 'text-green-600' : 'text-gray-400' }}">
                                <x-icon-check-circle />
                            </div>
                        </x-slot>
                        
                        <x-slot name="title">
                            <div class="mb-1 inline-block rounded-md py-0.5 font-bold px-2 bg-slate-800 text-white">{{ $changelog->version }}</div>
                        </x-slot>

                        <x-slot name="subtitle">
                            <span class="font-medium">{{ $changelog->published_at?->format('F d, Y') }}</span>
                        </x-slot>
                        
                        <div class="prose prose-sm">
                            {!! $changelog->content_html !!}
                        </div>
                    </x-timeline>
                @endforeach
            </x-card>
        @else
            <x-card-empty />
        @endif
    </x-section-centered>
</div>
