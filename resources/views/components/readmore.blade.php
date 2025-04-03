@props([
    'content' => 'hello',
    'limit' => 100,
])

@php
 $characterCount = strlen($content);
@endphp

<div x-data="{ open: false }" x-ref="readmore" x-cloak>
    <div x-show="!open">
        {!! str()->limit(strip_tags(trim($content ?? '')), (int) $limit) !!} 
    </div>

    @if($limit <= $characterCount)
    	<a href="#0" class="{{ $linkClass ?? 'text-sm text-indigo-600 hover:underline' }}" x-on:click.prevent="open = true" x-show="! open">Show more</a>
    @endif
    <div x-show="open">
        <div>
            {!! nl2br(e($content)) ?? '' !!}
        </div>
        <a 
            class="{{ $linkClass ?? 'text-sm text-indigo-600 hover:underline' }}"
            href="#0" 
            x-on:click.prevent="
                open = false; 
                $refs.readmore.scrollIntoView({block: 'nearest', behaviour: 'smooth'})
            " 
            x-show="open"
        >Show less</a>
    </div>
</div>