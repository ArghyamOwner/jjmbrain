<div 
	x-data="{ 
		open: false,
		hasScrolled: false,
		isOverflown() {
			if (this.$el.scrollHeight > this.$refs.overflowContainer.offsetHeight) {
                this.hasScrolled = true;
            } else {
                this.hasScrolled = false;
            }
		}
	}" 
	x-init="() => { $refs.overflowContainer.scrollHeight > 614 ? hasScrolled = true : hasScrolled = false }"
	x-cloak @opensidebar.window="open = true">
	
	{{-- Overlay --}}
	<div x-on:click="open = false" class="lg:hidden fixed inset-0 z-30 bg-slate-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300" :class="{'opacity-75 pointer-events-auto': open, 'opacity-0 pointer-events-none': !open}" x-cloak></div>

	<div class="fixed h-full inset-y-0 left-0 flex flex-col z-40 max-w-xs w-full w-64 lg:w-64 bg-slate-800 transform ease-in-out duration-300 -translate-x-full lg:translate-x-0" :class="{'translate-x-0': open, '-translate-x-full': !open}">
		
		{{-- Brand/Logo --}}
		<div class="flex items-center px-3 py-2 h-16 bg-slate-900">
			{{ $logo }}
		</div>

		<div class="px-3 py-3 flex-1 h-0 overflow-y-auto scrollbar" x-on:scroll="isOverflown()" x-ref="overflowContainer">
			{{ $slot }}
		</div>

		<div class="mt-auto" :class="{ 'border-t border-dashed border-slate-700': hasScrolled }">
			{{ $footer }}
		</div>
	</div>
</div>
