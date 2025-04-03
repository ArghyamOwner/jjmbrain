@props([
    'noPadding' => false,
    'overflowHidden' => false,
    'formAction' => false,
    'shadow' => 'default',
    'iconColor' => 'text-indigo-500',
    'iconBgColor' => 'bg-indigo-50',
    'iconSize' => 'w-12 h-12',
    'bgColor' => 'bg-white',
    'tag' => 'div'
])

@php
    $shadowClass = [
        'xs' => 'shadow-none ring-1 ring-slate-200',
        'small' => 'shadow-md hover:shadow-md',
        'default' => 'shadow hover:shadow-md',
        'medium' => 'shadow-md hover:shadow-md',
        'large' => 'shadow-lg hover:shadow-md',
        'none' => 'shadow-none'
    ][$shadow];
@endphp

 
<{{ $tag }} {{ 
		$attributes->class([
            'transition-all duration-300 rounded-lg flex flex-col h-full relative',
            'px-5 py-4 relative leading-5 flex-1' => ! $noPadding,
            $shadowClass,
            $bgColor
		])->merge() 
	}}>
        <div 
            @class([
                'flex',
                'px-5 py-4' => $noPadding,
            ])
        >
            @isset($iconLeft)
                <div 
                    {{ $iconLeft->attributes->class([
                        'relative rounded-lg flex items-center justify-center shrink-0 mr-4',
                        $iconBgColor,
                        $iconColor,
                        $iconSize
                    ])->merge() }}>
                    {{ $iconLeft }}
                </div>
            @endisset

            <div class="flex-1">
                @isset($title)
                    <p {{ $title->attributes->class([
                        'text-sm text-gray-600 font-medium shrink-0 leading-none mb-1'
                    ])->merge() }}>{{ $title }}</p>
                @endisset

                {{ $slot }}
            </div>

           @isset($iconRight)
                <div 
                    {{ $iconRight->attributes->class([
                        'relative rounded-lg flex items-center justify-center shrink-0 ml-4',
                        $iconBgColor,
                        $iconColor,
                        $iconSize
                    ])->merge() }}>
                    {{ $iconRight }}
                </div>
            @endisset
        </div>
    
    @if(isset($footer))
        <div {{ $footer->attributes->merge(['class' => 'px-5 py-2 bg-gray-50 rounded-b-lg overflow-hidden']) }}>
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>
 