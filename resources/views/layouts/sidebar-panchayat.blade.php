@auth
<x-sidebar>
	<x-slot name="logo">
		<x-application-logo class="!text-gray-100 text-lg" />
	</x-slot>

	<x-nav-item to="{{ route('profile') }}" class="flex">
		<div class="flex px-1 mb-4 items-center">
			<div class="h-8 w-8 rounded shrink-0 overflow-hidden">
				<img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}"
					class="h-8 w-8 rounded object-cover" loading="lazy" />
			</div>
			<div class="flex-1 px-2 overflow-hidden">
				<div class="text-sm font-medium truncate text-slate-300">{{ auth()->user()->name }}</div>
				<div class="text-xs text-slate-400 truncate leading-tight">Role: {{ Str::headline(auth()->user()->role)
					}}</div>
			</div>
		</div>
	</x-nav-item>

	<x-nav-item to="{{ route('dashboard') }}" class="flex items-center py-2">
		<x-icon-home class="mr-4 text-slate-400 w-5 h-5" />Home
	</x-nav-item>

	<x-nav-item to="{{ route('grievanceDashboard') }}" class="flex items-center py-2">
		<x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Grievance Dashboard
	</x-nav-item>

	<x-nav-item to="{{ route('schemes') }}" class="flex items-center py-2">
		<x-icon-folder class="mr-4 text-slate-400 w-5 h-5"/>Schemes
	</x-nav-item>

	<x-nav-item to="{{ route('schemes', ['status'=> 'handed-over']) }}" class="flex items-center py-2">
		<x-icon-folder class="mr-4 text-slate-400 w-5 h-5"/>Handover Schemes
	</x-nav-item>

	<x-nav-item to="{{ route('jm.users') }}" class="flex items-center py-2">
		<x-icon-user class="mr-4 text-slate-400 w-5 h-5"/>JM Users
	</x-nav-item>

	<x-nav-item to="{{ route('wucs') }}" class="flex items-center py-2">
		<x-icon-droplets class="mr-4 text-slate-400 w-5 h-5"/>WUCs
	</x-nav-item>

	<x-nav-item to="{{ route('panchayatPayments') }}" class="flex items-center py-2">
		<x-icon-note class="mr-4 text-slate-400 w-5 h-5"/>Report O&M Expenses
	</x-nav-item>

	<div class="my-3"></div>

	<x-slot name="footer">
		<div class="px-4 py-4">
			{{-- <x-nav-item :active="(request()->is('docs/*')) ? true : false" to="{{ url('docs/home') }}"
				class="flex items-center py-2 text-slate-200">
				<x-icon-book-open class="mr-4 text-slate-400 w-5 h-5" />Documentation
			</x-nav-item> --}}
			<x-nav-item to="{{ route('changelogs') }}" target='_blank' class="flex items-center py-2">
				<x-icon-info-circle class="mr-4 text-slate-400 w-5 h-5" />Changelogs
			</x-nav-item>
			<form method="POST" action="{{ route('logout') }}">
				@csrf

				<x-nav-item class="flex items-center py-2 text-slate-200" to="{{ route('logout') }}"
					onclick="event.preventDefault(); this.closest('form').submit();">
					<x-icon-logout class="mr-4 text-slate-400 w-5 h-5" />Log out
				</x-nav-item>
			</form>

			<div class="mt-2 mb-3 h-px border-b border-slate-700"></div>

			<p class="text-xs text-slate-400/75 pl-2">{{ config('app.name') }} &copy; {{ date('Y') }}</p>
			<p class="text-xs text-slate-400/75 pl-2">Powered by Sumato.</p>
		</div>
	</x-slot>
</x-sidebar>
@endauth