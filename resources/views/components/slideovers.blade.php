<div x-data="{ open: @entangle($attributes->wire('model')).defer }" x-on:toggle-slideover.window="open = !open"  x-cloak>
	<div class="fixed inset-0 overflow-hidden" x-show="open" style="z-index: 5000">
		<div class="absolute inset-0 overflow-hidden"
			x-show="open"
			x-transition:enter="ease-in-out duration-500"
			x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
			x-transition:leave="ease-in-out duration-500"
			x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
		>
			<div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
			<section class="absolute inset-y-0 right-0 pl-10 max-w-full flex" aria-labelledby="slide-over-heading"
				x-show="open"
				x-on:click.away="open = false"
				x-transition:enter="transform transition ease-in-out duration-500"
				x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
				x-transition:leave="transform transition ease-in-out duration-500"
				x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
			>
				<div class="relative w-screen max-w-md">
					<div class="absolute top-0 right-0 mr-4 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
						<button class="rounded-md text-gray-300 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-white" type="button" x-on:click="open = false">
							<span class="sr-only">Close panel</span>
							<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
					<div class="h-full flex flex-col bg-white shadow-xl overflow-y-auto">
						@isset($header)
							<div class="border-b flex shrink-0 items-center h-12 md:h-16 px-6 text-lg md:text-xl font-bold text-gray-800">{{ $header }}</div>
						@endisset
						
						{{ $slot }}
					</div>
				</div>
			</section>
		</div>
	</div>	 
</div>