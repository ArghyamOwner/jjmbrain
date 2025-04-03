<div class="h-screen flex flex-col lg:flex-row bg-slate-100">
    <div class="lg:flex-1 bg-white shadow border-r items-center h-full">
         <div class="flex flex-col h-full w-full items-center">

            <div class="w-full h-full items-center px-6 md:px-10 flex items-center max-w-lg mx-auto">
                <div class="flex-1">
                    @isset($logo)
                        {{ $logo }}
                    @endisset

                    {{ $slot }}
                </div>
            </div>
    
            @isset($footer)
                <div {{ $footer->attributes->class(['mt-auto']) }}>
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
    <div class="bg-slate-200 hidden lg:block lg:flex-1 relative">
        {{ $backgroundImage }}
    </div>
</div>
