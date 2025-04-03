<div>
    <div class="inline-flex items-center space-x-3 mt-5"
        x-data="{
            count: parseInt('{{ $count  }}'),
            isLiked: Boolean('{{ $newsIsLiked }}'),
            toggleLike() {
                if (this.isLiked == false) {
                    ++this.count 
                    this.isLiked = true
                } else {
                    --this.count
                    this.isLiked = false
                }
            },
            likeCount() {
                if (this.count === 1) {
                    return this.count + ' like'; 
                } else {
                    return this.count + ' likes'; 
                }
            }
        }"
        x-cloak
    >
        <button type="button" x-on:click="toggleLike();$wire.like()" class="focus:outline-none select-none p-0" wire:loading.attr="disabled">
            <svg x-show="isLiked" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M231.9,80.1a24.4,24.4,0,0,0-18-8.1H160V56a40.1,40.1,0,0,0-40-40,8.2,8.2,0,0,0-7.2,4.4L75,96H32a16,16,0,0,0-16,16v88a16,16,0,0,0,16,16H201.9a24.1,24.1,0,0,0,23.8-21l12-96A24.5,24.5,0,0,0,231.9,80.1ZM32,112H72v88H32Z"></path></svg>
            <svg x-show="!isLiked" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500" fill="none" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M32,104H80a0,0,0,0,1,0,0V208a0,0,0,0,1,0,0H32a8,8,0,0,1-8-8V112A8,8,0,0,1,32,104Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M80,104l40-80a32,32,0,0,1,32,32V80h61.9a15.9,15.9,0,0,1,15.8,18l-12,96a16,16,0,0,1-15.8,14H80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
        </button>
        <span class="font-medium text-slate-500" x-text="likeCount()"></span>
    </div>
</div>