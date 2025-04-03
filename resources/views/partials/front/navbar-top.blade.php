{{-- 
	x-init="showShadow()" 
	x-on:scroll.window="showShadow()" 
	class="sticky top-0 left-0 bg-transparent"
--}}
<div x-data="{
	openMobileMenu: false,
	showDropdown: false,
	shadow: false,
	showShadow() {
		this.shadow = this.$el.getBoundingClientRect().top == 0
			&& window.scrollY > 0
	}
}" x-cloak
	:class="{'shadow duration-1000 backdrop-filter backdrop-blur backdrop-contrast-100': shadow}"
	class="bg-white w-full transition-all md:py-1.5" style="z-index: 650">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8" x-on:click.away="openMobileMenu = false" x-cloak>
		<nav class="relative flex items-center justify-around w-full h-16">
			<div class="flex items-center justify-between flex-1 md:flex-none">
				<a href="{{ url('/') }}" aria-label="Home">
					<x-application-main-logo />
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
				@forelse ($menulinks as $menulink)
        			@if ($menulink->children->isNotEmpty())
						<x-dropdown align="left" trigger-on-hover>
							<x-slot name="trigger">
								<x-navbar-link href="#0" class="ml-8 inline-flex items-center group">{{ $menulink->name }}<x-icon-chevron-right class="rotate-90 w-4 h-4 text-slate-500 group-hover:text-sky-600" /></x-navbar-link>
							</x-slot>

							<x-slot name="content">
								@foreach ($menulink->children as $childlink)
									<x-dropdown-link class="flex items-center hover:text-sky-600" href="{{ $childlink->link ? url($childlink->link) : url($childlink->slug) }}">{{ $childlink->name }}</x-dropdown-link>
								@endforeach
							</x-slot>
						</x-dropdown>
					@else
						<x-navbar-link class="ml-8" href="{{ $menulink->link ? url($menulink->link) : url($menulink->slug) }}">{{
						$menulink->name }}</x-navbar-link>
					@endif	 
				@empty
					No menulinks found :)
				@endforelse
			  
				@auth
					<div class="mx-6 border-l w-0.5 h-8"></div>
						
					@includeWhen(auth()->user()->isAdministratorOrSuper(), 'partials.front.navbar-top-admin-dropdown')
					@includeWhen(auth()->user()->isUlbAdmin(), 'partials.front.navbar-top-ulb-dropdown')
				@endauth
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
							<x-application-logo />
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
						<a href="{{ route('admin.pages.home') }}"
							class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out {{ request()->routeIs('admin.pages.home') ? 'bg-slate-50 text-cyan-600' : 'text-slate-700' }}"
							role="menuitem">Home</a>
						{{-- <a href="/#cta"
							class="block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out"
							role="menuitem">About</a>
						<a href="/#features"
							class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out"
							role="menuitem">Features</a>
						<a href="/#changelogs"
							class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out"
							role="menuitem">Changelogs</a> --}}
					 
						{{-- <div class="border-t py-2 my-2">
							<span class="text-xs uppercase tracking-wider font-semibold text-slate-500 px-3">Legal</span>
							<a href="{{ route('privacy') }}"
								class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out"
								role="menuitem">Privacy Policy</a>
								
							<a href="{{ route('licence') }}"
								class="mt-1 block px-3 py-2 rounded-md text-base font-medium hover:text-cyan-700 hover:bg-slate-50 focus:outline-none focus:text-cyan-800 focus:bg-slate-50 transition duration-150 ease-in-out"
								role="menuitem">Licence</a>
						</div> --}}

						@auth
							<div class="border-t pt-4 pb-2 mt-2">
								<a href="{{ route('dashboard') }}" class="font-medium transition duration-150 ease-in-out bg-white shadow-sm block text-center text-cyan-700 px-4 py-2.5 hover:bg-slate-50 rounded-md truncate border">Go to dashboard</a>
							</div>
						@else
							<div class="border-t pt-4 pb-2 mt-2">
								<a  href="{{ route('login') }}" class="font-medium transition duration-150 ease-in-out bg-cyan-700 text-white px-4 py-2.5 hover:bg-cyan-500 rounded-md truncate block text-center shadow mt-2">Log in</a>
							</div>
						@endauth
					</div>
				</div>
			</div>
		</div>
	</div>
</div>