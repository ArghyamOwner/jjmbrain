@props([
    'noPadding' => false,
    'overflowHidden' => false,
    'formAction' => false,
    'shadow' => 'default',
    'iconColor' => 'text-indigo-500',
    'iconBgColor' => 'bg-white',
    'tag' => 'div'
])

@php
    $shadowClass = [
        'small' => 'shadow-md',
        'default' => 'shadow',
        'medium' => 'shadow-md',
        'large' => 'shadow-lg',
    ][$shadow];
@endphp

<div class="bg-white hover:shadow-md transition-all duration-300 rounded-lg flex flex-col h-full relative overflow-hidden {{ $shadowClass }}">
    <div class="flex items-center p-4 space-x-4">
        @isset($iconBefore)
            <div class="rounded-lg shadow-sm border flex items-center justify-center h-12 w-12 {{ $iconBgColor }} {{ $iconColor }}">
                {{ $iconBefore }}
            </div>
        @endisset

        <{{ $tag }} {{ 
            $attributes->merge([
                'class' => 'flex-1 leading-5'
            ]) 
        }}>
            {{ $slot }}
        </{{ $tag }}>

        @isset($iconAfter)
            <div class="rounded-lg shadow-sm border flex items-center justify-center h-12 w-12 {{ $iconBgColor }} {{ $iconColor }}">
                {{ $iconAfter }}
            </div>
        @endisset
    </div>

    @if(isset($footer))
        <div {{ $footer->attributes->merge(['class' => 'px-5 py-2 bg-gray-50 rounded-b-lg']) }}>
            {{ $footer }}
        </div>
    @endif
</div>
