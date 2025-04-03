<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Inspection Details</x-slot>

        <div class="py-3 px-6">
            @if($inspection)
                <div class="divide-y">
                    @if ($inspection->meta)
                        @foreach($inspection->meta as $question)
                            <div class="py-2">
                                <div class="mb-1 text-sm text-slate-800 font-bold">
                                    Q: {{ $question['question_title'] }}
                                </div>
                                <div class="text-sm">A: {{ $question['selected_option'] }}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </x-slideovers>
</div>
