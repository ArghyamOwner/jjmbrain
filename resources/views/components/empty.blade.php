<div {{ $attributes->merge(['class' => 'md:px-10 py-20 shadow rounded-lg bg-white text-indigo-500']) }}>
    <div class="text-center flex justify-center flex-col w-full items-center">
        <div class="w-24 h-24 rounded-full mx-auto bg-indigo-50 flex items-center justify-center">
            <svg class="stroke-current w-16 h-16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.4" d="M14.5 4.5V6.5C14.5 7.6 15.4 8.5 16.5 8.5H18.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.4" d="M8 13H12" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.4" d="M8 17H16" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </div>

        <div class="mt-4 text-gray-500">
            {{ $slot->isEmpty() ? 'No data found.' : $slot }}
        </div>

    </div>
</div>
