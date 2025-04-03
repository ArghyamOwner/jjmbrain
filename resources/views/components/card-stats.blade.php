@props([
    'noPadding' => false,
    'overflowHidden' => false,
    'formAction' => false,
    'shadow' => 'default',
    'iconColor' => 'text-indigo-500',
    'iconBgColor' => 'bg-indigo-50',
    'tag' => 'div'
])

@php
    $shadowClass = [
        'small' => 'shadow-sm',
        'default' => 'shadow',
        'medium' => 'shadow-md',
        'large' => 'shadow-lg',
    ][$shadow];
@endphp

 
<{{ $tag }} {{ 
		$attributes->class([
            'bg-white hover:shadow-md transition-all duration-300 rounded-lg flex flex-col h-full relative overflow-hidden',
            'px-5 py-4 relative leading-5 flex-1' => ! $noPadding,
            $shadowClass
		])->merge() 
	}}>
        <div class="flex">
            @isset($iconLeft)
                <div 
                    {{ $iconLeft->attributes->class([
                        'relative rounded-lg flex items-center justify-center h-12 w-12 shrink-0 mr-4',
                        $iconBgColor,
                        $iconColor
                    ])->merge() }}>
                    {{ $iconLeft }}
                </div>
            @endisset

            <div class="flex-1">
                @isset($title)
                    <p {{ $title->attributes->class([
                        'text-sm text-slate-500 font-medium'
                    ])->merge() }}>{{ $title }}</p>
                @endisset

                {{ $slot }}
            </div>

           @isset($iconRight)
                <div 
                    {{ $iconRight->attributes->class([
                        'relative rounded-lg flex items-center justify-center h-12 w-12 shrink-0 ml-4',
                        $iconBgColor,
                        $iconColor
                    ])->merge() }}>
                    {{ $iconRight }}
                </div>
            @endisset
        </div>
    
    @if(isset($footer))
        <div {{ $footer->attributes->merge(['class' => 'px-5 py-2 bg-slate-50 rounded-b-lg']) }}>
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>
 