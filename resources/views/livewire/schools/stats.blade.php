<div>
    <div wire:init="getSchoolStats">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <x-card-stats>
                <x-slot name="title">Total Schools</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $totalSchools }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">CBSE Schools</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $totalCbseSchools }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">ICSE Schools</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $totalIcseSchools }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">ISC Schools</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $totalIscSchools }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">APBE Schools</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $totalApbeSchools }}</x-heading>
            </x-card-stats>
        </div>
    </div>
</div>
