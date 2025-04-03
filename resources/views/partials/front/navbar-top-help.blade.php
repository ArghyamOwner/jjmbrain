<div x-data="{
	openMobileMenu: false,
	showDropdown: false,
}" x-cloak
	class="bg-white w-full transition-all md:py-1.5" style="z-index: 650">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8" x-on:click.away="openMobileMenu = false" x-cloak>
		<nav class="relative flex items-center justify-around w-full h-16">
			<div class="flex items-center justify-between flex-1 md:flex-none">
				<a href="{{ url('/') }}" aria-label="Home">
					<div class="flex items-center">
						<svg class="w-10 h-10 -ml-1 mr-1 shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M195.88,195.88l-39.6-39.6a40,40,0,0,0,0-56.56l39.6-39.6A96,96,0,0,1,195.88,195.88ZM60.12,60.12a96,96,0,0,0,0,135.76l39.6-39.6a40,40,0,0,1,0-56.56Z" opacity="0.2"></path><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm39.1,131.79a47.84,47.84,0,0,0,0-55.58l28.5-28.49a87.83,87.83,0,0,1,0,112.56ZM96,128a32,32,0,1,1,32,32A32,32,0,0,1,96,128Zm88.28-67.6L155.79,88.9a47.84,47.84,0,0,0-55.58,0L71.72,60.4a87.83,87.83,0,0,1,112.56,0ZM60.4,71.72l28.5,28.49a47.84,47.84,0,0,0,0,55.58L60.4,184.28a87.83,87.83,0,0,1,0-112.56ZM71.72,195.6l28.49-28.5a47.84,47.84,0,0,0,55.58,0l28.49,28.5a87.83,87.83,0,0,1-112.56,0Z"></path></svg>
						<div>
							<div class="text-xl font-bold text-slate-800 tracking-tight">Help &amp; Support</div>
							<div class="flex items-center">
								<div class="h-0.5 bg-slate-200 flex-1 mr-2"></div>
								<div class="font-medium text-slate-400 text-xs uppercase tracking-wider relative">JJM Portal</div>
							</div>
						</div>
					</div>
				</a>
				<div class="-mr-2 flex items-center md:hidden" x-on:click="openMobileMenu = !openMobileMenu">
					<button type="button"
						class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-white focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out"
						id="main-menu" aria-label="Main menu" aria-haspopup="true">
						<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4 6h16M4 12h16M4 18h16" />
						</svg>
					</button>
				</div>
			</div>

			<div class="hidden md:flex md:flex-1 text-right w-full md:items-center md:justify-end">
				<x-navbar-link class="ml-8" href="{{ route('helpdesk') }}">Home</x-navbar-link>
				<x-navbar-link class="ml-8" href="{{ config('app.url') }}">JJM Brain</x-navbar-link>
			</div>
		</nav>

		<div x-show="openMobileMenu" x-transition:enter="transition ease-out duration-150"
			x-transition:enter-start="opacity-0 transform scale-95"
			x-transition:enter-end="opacity-100 transform scale-100"
			x-transition:leave="transition ease-in duration-100"
			x-transition:leave-start="opacity-100 transform scale-100"
			x-transition:leave-end="opacity-0 transform scale-95"
			class="absolute z-40 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
			<div class="rounded-lg shadow-md border">
				<div class="rounded-lg bg-white shadow-xs overflow-hidden" role="menu" aria-orientation="vertical"
					aria-labelledby="main-menu">
					<div class="px-5 pt-2 flex items-center justify-between">
						<div>
							<div class="flex items-center">
								<svg class="w-10 h-10 -ml-1 mr-1 shrink-0 text-indigo-600" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M195.88,195.88l-39.6-39.6a40,40,0,0,0,0-56.56l39.6-39.6A96,96,0,0,1,195.88,195.88ZM60.12,60.12a96,96,0,0,0,0,135.76l39.6-39.6a40,40,0,0,1,0-56.56Z" opacity="0.2"></path><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm39.1,131.79a47.84,47.84,0,0,0,0-55.58l28.5-28.49a87.83,87.83,0,0,1,0,112.56ZM96,128a32,32,0,1,1,32,32A32,32,0,0,1,96,128Zm88.28-67.6L155.79,88.9a47.84,47.84,0,0,0-55.58,0L71.72,60.4a87.83,87.83,0,0,1,112.56,0ZM60.4,71.72l28.5,28.49a47.84,47.84,0,0,0,0,55.58L60.4,184.28a87.83,87.83,0,0,1,0-112.56ZM71.72,195.6l28.49-28.5a47.84,47.84,0,0,0,55.58,0l28.49,28.5a87.83,87.83,0,0,1-112.56,0Z"></path></svg>
								<div>
									<div class="text-xl font-bold text-slate-800 tracking-tight">Help &amp; Support</div>
									<div class="flex items-center">
										<div class="h-0.5 bg-slate-200 flex-1 mr-2"></div>
										<div class="font-medium text-slate-400 text-xs uppercase tracking-wider relative">JJM Portal</div>
									</div>
								</div>
							</div>
						</div>
						<div class="-mr-2">
							<button x-on:click="openMobileMenu = !openMobileMenu" type="button"
								class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out"
								aria-label="Close menu">
								<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
					</div>
					<div class="px-2 pt-2 pb-3 border-t mt-2">
						<a href="{{ route('helpdesk') }}"
							class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-indigo-700 hover:bg-slate-50 focus:outline-none focus:text-indigo-800 focus:bg-slate-50 transition duration-150 ease-in-out"
							role="menuitem">Home</a>
						
						<a href="{{ config('app.url') }}"
							class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-indigo-700 hover:bg-slate-50 focus:outline-none focus:text-indigo-800 focus:bg-slate-50 transition duration-150 ease-in-out"
							role="menuitem">JJM Brain</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>