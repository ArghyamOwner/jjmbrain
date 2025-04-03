<div>
    <x-card>
        <x-slot:header>
            <x-heading size="md">Lithology Diagram</x-heading>
        </x-slot>

        <x-slot:action>
            <x-button color="white" tag="a" href="{{ route('lithologs.download', $litholog) }}" class="mb-2 text-indigo-600" with-icon icon="download">Download Lithology Report</x-button>
        </x-slot>
    
        <div class="relative w-full" style="min-height: 850px"> 
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                <div class="mx-auto max-w-sm md:max-w-xl w-full p-4 transform rotate-90" 
                    x-data="{ 
                        gridData: @js($lithologies),
                        casingData: @js($caseDiagram),
                        waterLogData: @js($waterLevel),
                        calculateCasingWidth() {
                            const maxValue = this.getMaxValueFromArrayOfJSON(this.casingData, 'to')
                            return maxValue / this.casingData.length;
                        },
        
                        calculateWaterLogWidth() {
                            const maxValue = this.getMaxValueFromArrayOfJSON(this.waterLogData, 'to')
                            return maxValue / this.waterLogData.length;
                        },
        
                        calculateWidth() {
                            const maxValue = this.getMaxValueFromArrayOfJSON(this.gridData, 'to')
                            return maxValue / this.gridData.length;
                        },
        
                        getMaxValueFromArrayOfJSON(jsonArray, property) {
                            let maxValue = Number.MIN_VALUE;
                        
                            for (const obj of jsonArray) {
                                if (obj.hasOwnProperty(property) && typeof obj[property] === 'number') {
                                    if (obj[property] > maxValue) {
                                    maxValue = obj[property];
                                    }
                                }
                            }
                        
                            return maxValue;
                        } 
                    }" x-cloak>
        
                    <!-- Water Level -->
                    <div class="relative" x-show="waterLogData.length">
                        <div class="flex items-center w-full mb-4">
                            <template x-for="(waterlogitem, waterlogitemKey) in waterLogData">
                                <div 
                                    x-data="{ tooltip: waterlogitem.remarks }"
                                    x-tooltip="tooltip"
                                    class="h-32 border-l border-t border-b border-gray-900 flex items-center justify-center relative"
                                    :class="{ 'border-r' : waterlogitemKey + 1 == waterLogData.length }"
                                    x-bind:style="'width:' + (waterlogitem.to - waterlogitem.from) * calculateWaterLogWidth() + '%; background-image: url(/img/litholog/' + waterlogitem.code + ')'">
                                </div>
                            </template>
                        </div>
        
                        <div class="flex items-center w-full mb-10">
                            <template x-for="(waterlogitem, waterlogitemKey) in waterLogData">
                                <div class="flex items-center relative border-t border-gray-900"
                                    x-bind:style="'width:' + (waterlogitem.to - waterlogitem.from) * calculateWaterLogWidth() + '%'">
                                    <span class="w-px h-1 border-l absolute left-0 top-0 border-gray-900"></span>
                                    <span class="w-px h-1 border-l absolute right-0 top-0 border-gray-900"
                                        x-show="waterlogitemKey + 1 == waterLogData.length"></span>
                                    <span x-text="waterlogitem.from"
                                        class="text-xs absolute -left-1.5 top-2 transform -rotate-90"></span>
                                    <span x-text="waterlogitem.to"
                                        class="text-xs absolute -right-2 top-2 transform -rotate-90"
                                        x-show="waterlogitemKey + 1 == waterLogData.length"></span>
                                </div>
                            </template>
                        </div>
                        <div class="absolute -rotate-90 -ml-16 -mt-32 text-sm">Water Level</div>
                    </div>
                    <!-- /Water Level -->
                    
                    <!-- Casing Diagram -->
                    <div class="relative" x-show="casingData.length">
                        <div class="hidden md:flex items-center w-full mb-4">
                            <template x-for="(casingitem, casingitemKey) in casingData">
                                <div class="h-48 border-l border-t border-b border-gray-900 flex items-center justify-center relative"
                                    :class="{ 'border-r' : casingitemKey + 1 == casingData.length }"
                                    x-bind:style="'width:' + (casingitem.to - casingitem.from) * calculateCasingWidth() + '%'">
                                    <span x-text="casingitem.code_name"
                                        class="text-xs shrink-0 transform -rotate-90 absolute block truncate"></span>
                                </div>
                            </template>
                        </div>
                        <div class="flex items-center w-full mb-4 py-4 relative"
                            style="background-image: url('/img/litholog/10000.svg')">
                            <div class="absolute w-16 h-full" style="z-index:1; background-image: url('/img/litholog/30500.svg')"></div>
                            <template x-for="(casingitem, casingitemKey) in casingData">
                                <div 
                                    x-data="{ tooltip: casingitem.remarks }"
                                    x-tooltip="tooltip"
                                    class="border-l border-t border-b border-gray-900 flex items-center justify-center relative z-10"
                                    :class="{ 
                                        'border-r' : casingitemKey + 1 == casingData.length,
                                        'h-10': ['Casing Pipe Small', 'Well Cap Small', 'Fracture Small', 'Open Hole'].includes(casingitem.code_name),
                                        'h-16': !['Casing Pipe Small', 'Well Cap Small', 'Fracture Small', 'Open Hole'].includes(casingitem.code_name)
                                    }"
                                    x-bind:style="'width:' + (casingitem.to - casingitem.from) * calculateCasingWidth() + '%; background-image: url(/img/litholog/' + casingitem.code + ')'">
                                </div>
                            </template>
                        </div>
            
                        <div class="flex items-center w-full mb-10">
                            <template x-for="(casingitem, casingitemKey) in casingData">
                                <div class="flex items-center relative border-t border-gray-900"
                                    x-bind:style="'width:' + (casingitem.to - casingitem.from) * calculateCasingWidth() + '%'">
                                    <span class="w-px h-1 border-l absolute left-0 top-0 border-gray-900"></span>
                                    <span class="w-px h-1 border-l absolute right-0 top-0 border-gray-900"
                                        x-show="casingitemKey + 1 == casingData.length"></span>
                                    <span x-text="casingitem.from"
                                        class="text-xs absolute -left-1.5 top-2 transform -rotate-90"></span>
                                    <span x-text="casingitem.to"
                                        class="text-xs absolute -right-2 top-2 transform -rotate-90"
                                        x-show="casingitemKey + 1 == casingData.length"></span>
                                </div>
                            </template>
                        </div>
                        <div class="absolute -rotate-90 -ml-20 -mt-40 text-sm">Casing Diagram</div>
                    </div>
                    <!-- /Casing Diagram -->
        
                    <!-- Lithologies -->
                    <div class="relative">
                        <div class="hidden md:flex items-center w-full mb-4">
                            <template x-for="(item, itemKey) in gridData">
                                <div class="h-40 border-l border-t border-b border-gray-900 flex items-center justify-center relative"
                                    :class="{ 'border-r' : itemKey + 1 == gridData.length }"
                                    x-bind:style="'width:' + (item.to - item.from) * calculateWidth() + '%'">
                                    <span x-text="item.code_name"
                                        class="text-xs shrink-0 transform -rotate-90 absolute block truncate"></span>
                                </div>
                            </template>
                        </div>
            
                        <div class="flex items-center w-full mb-4">
                            <template x-for="(item, itemKey) in gridData">
                                <div 
                                    x-data="{ tooltip: item.remarks }"
                                    x-tooltip="tooltip"
                                    class="h-24 border-l border-t border-b border-gray-900 flex items-center justify-center"
                                    :class="{ 'border-r' : itemKey + 1 == gridData.length }"
                                    x-bind:style="'width:' + (item.to - item.from) * calculateWidth() + '%; background-image: url(/img/litholog/' + item.code + ')'">
                                </div>
                            </template>
                        </div>
            
                        <div class="flex items-center w-full">
                            <template x-for="(item, itemKey) in gridData">
                                <div class="flex items-center relative border-t border-gray-900"
                                    x-bind:style="'width:' + (item.to - item.from) * calculateWidth() + '%'">
                                    <span class="w-px h-2 border-l absolute left-0 top-0 border-gray-900"></span>
                                    <span class="w-px h-2 border-l absolute right-0 top-0 border-gray-900"
                                        x-show="itemKey + 1 == gridData.length"></span>
                                    <span x-text="item.from"
                                        class="text-xs absolute -left-1.5 top-3 transform -rotate-90"></span>
                                    <span x-text="item.to" class="text-xs absolute -right-2 top-3 transform -rotate-90"
                                        x-show="itemKey + 1 == gridData.length"></span>
                                </div>
                            </template>
                        </div>
                        
                        <div class="absolute -rotate-90 -ml-16 -mt-10 text-sm">Lithology</div>
                    </div>
                    <!-- /Lithologies -->
                </div>
            </div>
        </div>

    </x-card>
</div>
