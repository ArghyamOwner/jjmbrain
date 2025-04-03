@props(['for'])

<div
    x-data="{}"
    x-init="$nextTick(() => {
        let errorDiv = document.getElementsByClassName('invalid-feedback')[0];
        if (errorDiv) {
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
        }
    })"
>
    @error($for)
        <p {{ $attributes->merge(['class' => 'invalid-feedback text-sm text-red-600 flex flex-wrap items-center']) }}><svg xmlns="http://www.w3.org/2000/svg" class="mr-1 w-5 h-5 fill-current" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm-8,56a8,8,0,0,1,16,0v56a8,8,0,0,1-16,0Zm8,104a12,12,0,1,1,12-12A12,12,0,0,1,128,184Z"></path></svg>{{ $message }}</p>
    @enderror
</div>
 