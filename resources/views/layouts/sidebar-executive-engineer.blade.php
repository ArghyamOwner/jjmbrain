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

	<x-nav-item to="{{ route('news.feeds') }}" class="flex items-center py-2">
		<x-icon-file class="mr-4 text-slate-400 w-5 h-5" />News
	</x-nav-item>

	<x-nav-item to="{{ route('reports') }}" class="flex items-center py-2">
		<x-icon-chart class="mr-4 text-slate-400 w-5 h-5"/>Reports
	</x-nav-item>

	<x-nav-item to="{{ route('schemes') }}" class="flex items-center py-2">
		<x-icon-folder class="mr-4 text-slate-400 w-5 h-5" />Schemes
	</x-nav-item>

	<x-nav-item to="{{ route('no-water-report') }}" class="flex items-center py-2">
		<x-icon-folder class="mr-4 text-slate-400 w-5 h-5" />Water Disruption Report
	</x-nav-item>

	<x-nav-item to="{{ route('pg.dashboard') }}" class="flex items-center py-2">
		<x-icon-flag class="mr-4 text-slate-400 w-5 h-5" />PG Dashboard
	</x-nav-item>

	<x-nav-item to="{{ route('workorders') }}" class="flex items-center py-2">
		<x-icon-briefcase class="mr-4 text-slate-400 w-5 h-5" />Workorder Management
	</x-nav-item>

	{{-- <x-nav-item to="{{ route('assets') }}" class="flex items-center py-2">
		<x-icon-setting class="mr-4 text-slate-400 w-5 h-5" />Assets
	</x-nav-item> --}}

	{{-- <x-nav-item to="{{ route('waterQualityParameters') }}" class="flex items-center py-2 truncate">
		<x-icon-droplets class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Water Quality Parameters
	</x-nav-item> --}}

	{{-- <x-nav-item to="{{ route('activityDetails') }}" class="flex items-center py-2">
		<x-icon-list class="mr-4 text-slate-400 w-5 h-5" />I-PET Dashboard
	</x-nav-item> --}}

	<x-nav-item to="{{ route('wucs') }}" class="flex items-center py-2">
		<x-icon-droplets class="mr-4 text-slate-400 w-5 h-5" />WUC
	</x-nav-item>

	<x-nav-item to="{{ route('divisionDashboard') }}" class="flex items-center py-2">
		<x-icon-layer class="mr-4 text-slate-400 w-5 h-5" />Division Dashboard
	</x-nav-item>

	<x-nav-item to="{{ route('districtDashboard') }}" class="flex items-center py-2">
		<x-icon-layer class="mr-4 text-slate-400 w-5 h-5" />District Dashboard
	</x-nav-item>

	{{-- <x-nav-item to="{{ route('isa') }}" class="flex items-center py-2">
		<x-icon-droplets class="mr-4 text-slate-400 w-5 h-5" />ISA
	</x-nav-item> --}}


	{{-- <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Lab Management</div>

	<x-nav-item to="{{ route('items') }}" class="flex items-center py-2 truncate">
		<x-icon-list class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Items
	</x-nav-item>

	<x-nav-item to="{{ route('stocks') }}" class="flex items-center py-2 truncate">
		<x-icon-layer class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Stocks
	</x-nav-item>

	<x-nav-item to="{{ route('labs') }}" class="flex items-center py-2 truncate">
		<x-icon-beaker class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Labs
	</x-nav-item>

	<x-nav-item to="{{ route('transfers') }}" class="flex items-center py-2 truncate">
		<x-icon-switch-horizontal class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Transfers
	</x-nav-item> --}}

	<div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Contractor Management</div>
	<x-nav-item to="{{ route('contractors') }}" class="flex items-center py-2">
		<x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Contractors
	</x-nav-item>
	<x-nav-item to="{{ route('contractors.create') }}" class="flex items-center py-2">
		<x-icon-add class="mr-4 text-slate-400 w-5 h-5" />New Contactor
	</x-nav-item>

	<div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Greivence & Campaign</div>

	<x-nav-item to="{{ route('grievanceDashboard') }}" class="flex items-center py-2">
		<x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Grievance Dashboard
	</x-nav-item>

	{{-- <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Admin</div>
	<x-nav-item to="{{ route('admin.users') }}" class="flex items-center py-2">
		<x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Users
	</x-nav-item> --}}

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