<div>
    <x-card cardClasses="mb-4">
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2">
            <div class="flex-1  grid grid-cols-2">
                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Total Number of Contractors</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $counts->allCount ?? 'N/A' }}</div>
                </div>

                <div class="col-span-1 md:col-span-1 px-4 py-2">
                    <div class="font-semibold text-gray-500 text-sm truncate">Class-1 Contractors</div>
                    <div class="text-gray-800 font-bold text-lg">{{ "$counts->class1" }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Class-2 Contractors</div>
                    <div class="text-gray-800 font-bold text-lg">{{ "$counts->class2" }}</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Class-3 Contractors</div>
                    <div class="text-gray-800 font-bold text-lg">{{ "$counts->class3" }}</div>
                </div>

            </div>
            <div class="w-full md:w-64">
                <img loading="lazy" src="https://sumatoimg.nyc3.digitaloceanspaces.com/ino2021/galleries/d674eda7-7a6d-4957-b6b4-4af7cc5214fb.png"
                    class="object-contain h-32 mx-auto" />
            </div>
        </div>
    </x-card>
</div>
