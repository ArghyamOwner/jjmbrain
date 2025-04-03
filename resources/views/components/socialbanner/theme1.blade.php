 <div
    {{
        $attributes->merge([
            'class' => 'shadow bg-white rounded-lg overflow-hidden relative flex items-center'
        ])
    }}
 >
    <div class="-skew-y-12 w-full -mt-12 absolute top-0">
        <div class="grid grid-cols-6">
            <div class="h-12 col-span-1 bg-gray-200"></div>
            <div class="h-12 col-span-5 bg-white"></div>
        </div>
        <div class="grid grid-cols-4">
            <div class="h-12 col-span-1 bg-gray-100"></div>
            <div class="h-12 col-span-2 bg-white"></div>
            <div class="h-12 col-span-1 bg-gray-100"></div>
        </div>
        <div class="grid grid-cols-6">
            <div class="h-12 col-span-1 bg-indigo-600"></div>
            <div class="h-12 col-span-1 bg-indigo-300"></div>
            <div class="h-12 col-span-4 bg-white"></div>
        </div>
        <div class="grid grid-cols-8">
            <div class="h-12 col-span-6 bg-white"></div>
            <div class="h-12 col-span-2 bg-indigo-600"></div>
        </div>
        <div class="grid grid-cols-8">
            <div class="h-12 col-span-7 bg-white"></div>
            <div class="h-12 col-span-1 bg-indigo-300"></div>
        </div>
    </div>

    <div class="relative z-10 px-4 md:px-0 md:max-w-xl md:mx-auto py-6">
        <h2 class="font-bold text-gray-800 text-center text-5xl">{{ $title ?? 'Title Goes Here' }}</h2>
        <p class="text-gray-600 text-center mt-5 font-mono">{{ $author ?? 'Author Name' }}</p>
    </div>

    <div class="-skew-y-12 w-full -mb-20 absolute bottom-0">
        <div class="grid grid-cols-5">
            <div class="h-12 col-span-1 bg-indigo-600"></div>
            <div class="h-12 col-span-4 bg-white"></div>
        </div>
        <div class="grid grid-cols-4">
            <div class="h-12 col-span-1 bg-gray-100"></div>
            <div class="h-12 col-span-2 bg-white"></div>
            <div class="h-12 col-span-1 bg-gray-100"></div>
        </div>
        <div class="grid grid-cols-6">
            <div class="h-12 col-span-1 bg-indigo-600"></div>
            <div class="h-12 col-span-1 bg-indigo-300"></div>
            <div class="h-12 col-span-4 bg-white"></div>
        </div>
        <div class="grid grid-cols-8">
            <div class="h-12 col-span-6 bg-white"></div>
            <div class="h-12 col-span-2 bg-indigo-600"></div>
        </div>
        <div class="grid grid-cols-8">
            <div class="h-12 col-span-7 bg-white"></div>
            <div class="h-12 col-span-1 bg-indigo-300"></div>
        </div>
    </div>
</div>