<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-slate-100 relative overflow-hidden">

    <div class="absolute inset-0 text-indigo-100 z-10" style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="absolute z-20 left-0 top-0 w-full bg-gradient-to-b from-slate-100 h-3/4"></div>
    <div class="absolute z-20 bottom-0 w-full bg-gradient-to-t from-slate-100 h-2/3"></div>
 
    <div class="relative z-20 w-full flex flex-col items-center">
        <div>
            {{ $logo }}
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 md:p-10 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        @isset($footer)
            <div>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
