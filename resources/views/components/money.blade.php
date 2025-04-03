@props([
    'id' => null,
    'label' => null,
    'name' => null,
    'hint' => null,
    'withErrorMessage' => true,
    'errorMessageFor' => null,
    'optional' => false,
    'noMargin' => false,
    'appendAfter' => null,
    'appendBefore' => '&#8377;',
    'readonly' => false,
    'type' => 'text',
    'options' => [
        'numeral' => true,
        'numeralThousandsGroupStyle' => 'lakh'
    ],
])

{{-- INR Symbol = &#8377; or &#x20B9; --}}

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}" x-data="{
        cleaveInstance: null,
        options: {{ json_encode($options) }},
        inWords: '',
        displayAmountToText() {
            if (this.$refs.input.value == 0) return this.inWords = '';
            this.inWords = numberToWords(parseFloat(this.$refs.input.value.replace(/,/g, ''))) + ' Rupees'
        },
        @if ($attributes->has('wire:model') || $attributes->has('wire:model.defer'))  
			value: @entangle($attributes->wire('model'))
		@else
			value: '{{ $value ?? 0 }}'
		@endif
    }" 
    x-init="cleaveInstance = new Cleave($refs.input, {
            ...options,
            onValueChanged: (e) => {
                value = e.target.value;
            }
        }); 
        $nextTick(() => { cleaveInstance.setRawValue(value); displayAmountToText(); })
        $watch('value', value => displayAmountToText())
    "
    x-cloak>
    @if ($label)
        <x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

    <div class="relative">
        @isset($appendBefore)
            <span
                class="select-none text-gray-400 absolute top-0 left-0 text-sm leading-5 font-medium pl-3 inline-flex h-full items-center">{!! $appendBefore !!}</span>
        @endisset

        <input
            x-on:input.debounce.500ms="displayAmountToText()"
            x-ref="input" 
            id="{{ $id ?? $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            
            {{ $attributes->class([
				'form-input transition duration-150 ease-in-out pl-6 pr-3 py-2 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 border-b sm:text-sm placeholder-gray-400 disabled:bg-gray-200 bg-white border-gray-300 shadow-sm' => true,
				'border-red-300' => $errors->has($name) && $withErrorMessage,
				'bg-gray-200' => $readonly
			]) }}
            
            x-model="value"
            :value="value"
        />
 
        @isset($appendAfter)
            <span
                class="select-none text-gray-400 absolute top-0 right-0 text-sm leading-5 font-medium pr-3 inline-flex h-full items-center">{!! $appendAfter !!}</span>
        @endisset
    </div>

    <div x-text="inWords" x-show="inWords.length" x-transition x-cloak class="mt-2 text-xs text-gray-600"></div>

    @if ($withErrorMessage)
        <x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
    @endif

    @isset($hint)
        <x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
    @endisset
</div>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
        <script>
            function numberToWords(amount) {
                let number = amount.toString().replace(/\s+/g, '');

                let numberSystems = [{
                    value: 10000000,
                    str: "Crore"
                }, {
                    value: 100000,
                    str: "Lakh"
                }, {
                    value: 1000,
                    str: "Thousand"
                }, {
                    value: 100,
                    str: "Hundred"
                }, {
                    value: 90,
                    str: "Ninety"
                }, {
                    value: 80,
                    str: "Eighty"
                }, {
                    value: 70,
                    str: "Seventy"
                }, {
                    value: 60,
                    str: "Sixty"
                }, {
                    value: 50,
                    str: "Fifty"
                }, {
                    value: 40,
                    str: "Forty"
                }, {
                    value: 30,
                    str: "Thirty"
                }, {
                    value: 20,
                    str: "Twenty"
                }, {
                    value: 19,
                    str: "Nineteen"
                }, {
                    value: 18,
                    str: "Eighteen"
                }, {
                    value: 17,
                    str: "Seventeen"
                }, {
                    value: 16,
                    str: "Sixteen"
                }, {
                    value: 15,
                    str: "Fifteen"
                }, {
                    value: 14,
                    str: "Fourteen"
                }, {
                    value: 13,
                    str: "Thirteen"
                }, {
                    value: 12,
                    str: "Twelve"
                }, {
                    value: 11,
                    str: "Eleven"
                }, {
                    value: 10,
                    str: "Ten"
                }, {
                    value: 9,
                    str: "Nine"
                }, {
                    value: 8,
                    str: "Eight"
                }, {
                    value: 7,
                    str: "Seven"
                }, {
                    value: 6,
                    str: "Six"
                }, {
                    value: 5,
                    str: "Five"
                }, {
                    value: 4,
                    str: "Four"
                }, {
                    value: 3,
                    str: "Three"
                }, {
                    value: 2,
                    str: "Two"
                }, {
                    value: 1,
                    str: "One"
                }];

                var result = '';
                for (var n of numberSystems) {
                    if (number >= n.value) {
                        if (number <= 99) {
                            result += n.str;
                            number -= n.value;
                            if (number > 0) result += ' ';
                        } else {
                            var t = Math.floor(number / n.value);
                            // console.log(t);
                            var d = number % n.value;
                            if (d > 0) {
                                return numberToWords(t) + ' ' + n.str + ' ' + numberToWords(d);
                            } else {
                                return numberToWords(t) + ' ' + n.str;
                            }

                        }
                    }
                }
                return result;
            }
        </script>
    @endpush
@endonce
