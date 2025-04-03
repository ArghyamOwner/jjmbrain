@props([
    'value' => null,
    'optional' => false
])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-slate-800']) }}>
    {{ $value ?? $slot }}

    @if($optional === true)
        <span class="text-slate-400 ml-1 font-normal">(Optional)</span>
    @endif
</label>
