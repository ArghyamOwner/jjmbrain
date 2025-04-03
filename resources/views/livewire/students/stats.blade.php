<div>
    <div wire:init="getStudentStats">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-task class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Attending Students</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $attendingStudents }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $attendingMaleStudents }} / F: {{ $attendingFemaleStudents }}</div>
                </div>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-help-circle class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Dropout Students</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $dropoutStudents }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $dropoutMaleStudents }} / F: {{ $dropoutFemaleStudents }}</div>
                </div>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="iconLeft">
                    <x-icon-shield-tick class="w-8 h-8" />
                </x-slot>
                <x-slot name="title">Total Passed Students</x-slot>
                <div class="flex items-center justify-between">
                    <x-heading size="3xl" class="font-mono">{{ $passedStudents }}</x-heading>

                    <div class="ml-2 text-slate-500 text-sm">M: {{ $passedMaleStudents }} / F: {{ $passedFemaleStudents }}</div>
                </div>
            </x-card-stats>
        </div>

        {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-card-stats>
                <x-slot name="title">CBSE Students</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $cbseStudents }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">ICSE Students</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $icseStudents }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">ISC Students</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $iscStudents }}</x-heading>
            </x-card-stats>
            <x-card-stats>
                <x-slot name="title">APBE Students</x-slot>
                <x-heading size="3xl" class="font-mono">{{ $apbeStudents }}</x-heading>
            </x-card-stats>
        </div> --}}
    </div>
</div>
