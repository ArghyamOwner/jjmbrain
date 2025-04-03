<div>
    <div wire:init="getTeacherStats">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-users class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Teachers</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $totalTeachers }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $totalMaleTeachers }} / F: {{ $totalFemaleTeachers }}</div>
                </div>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-file class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Contractual Teachers</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $totalContractualTeachers }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $totalMaleContractualTeachers }} / F: {{ $totalFemaleContractualTeachers }}</div>
                </div>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-shield-tick class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Permanent Teachers</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $totalPermanentTeachers }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $totalMalePermanentTeachers }} / F: {{ $totalFemalePermanentTeachers }}</div>
                </div>
            </x-card-stats>
        </div>
    </div>
</div>
