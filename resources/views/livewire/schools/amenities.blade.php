<div>
    <x-card overflow-hidden form-action="save">
        <x-heading size="lg" class="mb-4">School Amenities</x-heading>
        
        @if($facilities) 
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                @foreach($facilities as $key => $value)
                    <div class="flex space-x-3 items-start">
                        <div class="flex-1">
                            {{ Str::headline(Str::of($key)->beforeLast('|')) }}
                        </div>
                       
                        <x-input-switch
                            wire:model="facilities.{{ $key }}"  
                            on-value="true" 
                            off-value="false"
                        />
                    </div>
                @endforeach
            </div>
        @endif
        
        <x-slot name="footer" class="text-right">
            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card>
</div>
