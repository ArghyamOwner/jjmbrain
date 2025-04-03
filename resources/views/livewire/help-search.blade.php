<div>
    <x-heading size="3xl" class="mb-6 text-center text-white">Hi. How can we help you?</x-heading>
    <x-virtual-select-remote  
    no-margin
        name="query"
        wire:model="query" 
        search-method="searchHelp" custom-label
        :options="['placeholder' => 'Search...' ]"
    />
</div>
