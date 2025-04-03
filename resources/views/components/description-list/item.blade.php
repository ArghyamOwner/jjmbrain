@aware([
    'size' => 'default',
    'grid' => 'default'
])

@php
    $paddingClasses = [
        'xs' => 'py-1.5 text-sm',
        'sm' => 'py-2',
        'default' => 'py-2.5'
    ][$size];

    $gridClasses = [
        'one-by-two' => 'sm:grid sm:grid-cols-2',
        'default' => 'sm:grid sm:grid-cols-3',
        'no-break' => 'grid grid-cols-3'
    ][$grid];
@endphp

<div class="sm:gap-4 border-t border-slate-200 first-of-type:border-t-0 {{ $paddingClasses }} {{ $gridClasses }}">
    @isset($title)
        <dt {{ $title->attributes->class(["font-medium text-slate-500"]) }}>
            {{ $title ?? 'Title' }}
        </dt>
    @endisset
    
    <dd
        @class([
            'mt-1 text-slate-900 sm:mt-0 flex space-x-2 font-medium',
            'sm:col-span-2' => $grid === 'default'
        ])
    >
        <div {{ $description->attributes->class(["flex-1"]) }}>
            {{ $description ?? 'Description' }}
        </div>

        @isset($actions)
            {{ $actions }}
        @endisset
    </dd>
</div>
