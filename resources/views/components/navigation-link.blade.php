@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-indigo-600 font-medium'
            : 'inline-flex items-center text-slate-700 font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>