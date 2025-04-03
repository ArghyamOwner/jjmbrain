<x-dropdown>
	<x-slot:trigger>
		<button type="button" class="p-0 inline-flex items-center bg-gray-100 rounded-md">
			<img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" loading="lazy" class="rounded-md object-fit" height="32" width="32">
		</button>
	</x-slot>

	<x-slot name="content">
		<div class="px-4 py-1 text-xs text-left">
			<div class="font-medium text-sm truncate">{{ auth()->user()->name ?? 'John Wick' }}</div>
			<div class="text-slate-500 text-xs truncate">{{ Str::headline(auth()->user()->role) }}</div>
		</div>

		<div class="border-t border-gray-100 my-1"></div>

		<x-dropdown-link class="flex items-center" href="{{ route('dashboard') }}"><x-icon-arrow-right class="mr-4 text-slate-400 w-5 h-5 -rotate-45"/>Go to dashboard</x-dropdown-link>

		<x-dropdown-link class="flex items-center" href="{{ route('admin.homepageSettings') }}"><x-icon-tag class="mr-4 text-slate-400 w-5 h-5"/>Menu Settings</x-dropdown-link>

		<x-dropdown-link class="flex items-center" href="{{ route('admin.pages') }}"><x-icon-file class="mr-4 text-slate-400 w-5 h-5"/>Pages</x-dropdown-link>

		<x-dropdown-link class="flex items-center" href="{{ route('admin.homepageSettings') }}"><x-icon-layer class="mr-4 text-slate-400 w-5 h-5"/>Homepage Settings</x-dropdown-link>

		<form method="POST" action="{{ route('logout') }}">
			@csrf

			<x-dropdown-link class="flex items-center" href="{{ route('logout') }}"
					onclick="event.preventDefault(); this.closest('form').submit();">
				<x-icon-logout class="mr-4 text-slate-400 w-5 h-5"/>Log out
			</x-dropdown-link>
		</form>
	</x-slot>
</x-dropdown>