@props(['submit' => false])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>

            @if (isset($description))
                <p class="mt-1 text-sm text-gray-600">
                    {{ $description }}
                </p>
            @endif
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        @if($submit)
        <form wire:submit.prevent="{{ $submit }}">
        @endif
            <div class="shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-8 sm:rounded-md">
                    {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 sm:rounded-b-md">
                        {{ $actions }}
                    </div>
                @endif
            </div>

        @if($submit)
        </form>
        @endif
    </div>
</div>
