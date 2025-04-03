<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Habitation Related Schemes</x-slot>

        <div class="py-3 px-6">
            @if ($habitation?->schemes)
                @foreach ($habitation?->schemes as $scheme)
                    <div>
                        NAME: <x-text-link href="{{ route('schemes.show', $scheme->id) }}">
                            {{ $scheme->name }} 
                        </x-text-link> 
                        ( IMIS : <span class="text-blue-500">{{ $scheme->imis_id ?? '-' }}</span>)</div>
                    <div class="border-b mb-2 mt-2"></div>
                @endforeach
            @endif
        </div>
    </x-slideovers>
</div>