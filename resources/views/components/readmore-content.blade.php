@php
 
 $characterCount = strlen($content);
    
@endphp
<div x-data="{ open: false }" x-ref="readmore" x-cloak>
    <span x-show="!open">
        @if($characterCount <= $limit)
             {!! \Illuminate\Support\Str::replace('<p><br></p>', '', $content) ?? '' !!}
        @else
            {!! 
                \Illuminate\Support\Str::limit(
                    strip_tags(trim($content ?? '')), 
                    (int) $limit ?? 100
                ) 
            !!} 
        @endif
    </span>

    @if($limit <= $characterCount)
    <a href="#0" class="{{ $linkClass ?? '' }}" x-on:click.prevent="open = true" x-show="! open">Show more</a>
    @endif
    <div x-show="open">
        {!! \Illuminate\Support\Str::replace('<p><br></p>', '', $content) ?? '' !!}
        <a 
            class="{{ $linkClass ?? '' }}"
            href="#0" 
            x-on:click.prevent="
                open = false; 
                $refs.readmore.scrollIntoView({block: 'nearest', behaviour: 'smooth'})
            " 
            x-show="open"
        >Show less</a>
    </div>
</div>