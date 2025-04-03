@auth
    <x-sidebar>
        <x-slot name="logo">
            <x-application-logo class="!text-gray-100 text-lg" />
        </x-slot>

        <x-nav-item to="{{ route('profile') }}" class="flex">
            <div class="flex px-1 items-center">
                <div class="h-8 w-8 rounded shrink-0 overflow-hidden">
                    <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}"
                        class="h-8 w-8 rounded object-cover" loading="lazy" />
                </div>
                <div class="flex-1 px-2 overflow-hidden">
                    <div class="text-sm font-medium truncate text-slate-300">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-slate-400 truncate leading-tight">Role:
                        {{ Str::headline(auth()->user()->role) }}</div>
                </div>
            </div>
        </x-nav-item>

        <x-nav-item to="{{ route('dashboard') }}" class="flex items-center py-2">
            <x-icon-home class="mr-4 text-slate-400 w-5 h-5" />Home
        </x-nav-item>

        <x-nav-item to="{{ route('news.feeds') }}" class="flex items-center py-2">
            <x-icon-file class="mr-4 text-slate-400 w-5 h-5" />News
        </x-nav-item>

        <x-nav-item to="{{ route('notices') }}" class="flex items-center py-2">
            <x-icon-file class="mr-4 text-slate-400 w-5 h-5" />Notice
        </x-nav-item>

        <x-nav-item to="{{ route('meetingMinutes') }}" class="flex items-center py-2">
            <x-icon-file class="mr-4 text-slate-400 w-5 h-5" />Meetings
        </x-nav-item>

        <x-nav-item to="{{ route('tasks') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Task Management
        </x-nav-item>

        {{-- <x-nav-item to="{{ route('assets') }}" class="flex items-center py-2">
            <x-icon-setting class="mr-4 text-slate-400 w-5 h-5" />Assets
        </x-nav-item> --}}

        <x-nav-item to="{{ route('reports') }}" class="flex items-center py-2">
            <x-icon-chart class="mr-4 text-slate-400 w-5 h-5" />Reports
        </x-nav-item>

        <x-nav-item to="{{ route('stateDashboard') }}" class="flex items-center py-2">
            <x-icon-layer class="mr-4 text-slate-400 w-5 h-5" />State Dashboard
        </x-nav-item>
        
        <x-nav-item to="{{ route('divisionDashboard') }}" class="flex items-center py-2">
            <x-icon-layer class="mr-4 text-slate-400 w-5 h-5" />Division Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('districtDashboard') }}" class="flex items-center py-2">
            <x-icon-layer class="mr-4 text-slate-400 w-5 h-5" />District Dashboard
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Scheme Management</div>

        <x-nav-item to="{{ route('schemes') }}" class="flex items-center py-2">
            <x-icon-folder class="mr-4 text-slate-400 w-5 h-5" />Schemes
        </x-nav-item>

        <x-nav-item to="{{ route('no-water-report') }}" class="flex items-center py-2">
            <x-icon-folder class="mr-4 text-slate-400 w-5 h-5" />Water Disruption Report
        </x-nav-item>

        <x-nav-item to="{{ route('archivedSchemes') }}" class="flex items-center py-2">
            <x-icon-folder class="mr-4 text-slate-400 w-5 h-5" />Archived Schemes
        </x-nav-item>

        {{-- <x-nav-item to="{{ route('clusterMap') }}" class="flex items-center py-2">
            <x-icon-map class="mr-4 text-slate-400 w-5 h-5" />State Map
        </x-nav-item> --}}

        <x-nav-item to="{{ route('districtMap') }}" class="flex items-center py-2">
            <x-icon-map class="mr-4 text-slate-400 w-5 h-5" />District Map
        </x-nav-item>

        <x-nav-item to="{{ route('workorders') }}" class="flex items-center py-2">
            <x-icon-briefcase class="mr-4 text-slate-400 w-5 h-5" />Workorder Management
        </x-nav-item>

        <x-nav-item to="{{ route('apdcl.status') }}" class="flex items-center py-2">
            <x-icon-lamp-charge class="mr-4 text-slate-400 w-5 h-5" />APDCL Application
        </x-nav-item>

        <x-nav-item to="{{ route('lithologs.map') }}" class="flex items-center py-2">
            <x-icon-map class="mr-4 text-slate-400 w-5 h-5" />Litholog Map
        </x-nav-item>

        <x-nav-item to="{{ route('lithologDashboard') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Litholog Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('panchayatPaymentsCommissioner') }}" class="flex items-center py-2">
            <x-icon-note class="mr-4 text-slate-400 w-5 h-5"/>Report O&M Expenses
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">PG Management</div>

        <x-nav-item to="{{ route('pg.dashboard') }}" class="flex items-center py-2">
            <x-icon-flag class="mr-4 text-slate-400 w-5 h-5" />PG Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('pgs.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />Add New PG
        </x-nav-item>


        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">WUC Management</div>

        <x-nav-item to="{{ route('wucDashboard') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />WUC Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('wucs') }}" class="flex items-center py-2">
            <x-icon-droplets class="mr-4 text-slate-400 w-5 h-5" />WUC Listing
        </x-nav-item>

        <x-nav-item to="{{ route('wucs.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />Add WUC
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">ISA Management</div>

        <x-nav-item to="{{ route('isa') }}" class="flex items-center py-2">
            <x-icon-droplets class="mr-4 text-slate-400 w-5 h-5" />ISA Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('isa.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />Add ISA
        </x-nav-item>

        <x-nav-item to="{{ route('isaActivityDashboard') }}" class="flex items-center py-2">
            <x-icon-chart class="mr-4 text-slate-400 w-5 h-5" />ISA Activity Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('activityDetails') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />ISA Activity
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Campaign Management</div>

        <x-nav-item to="{{ route('campaigns') }}" class="flex items-center py-2">
            <x-icon-flag class="mr-4 text-slate-400 w-5 h-5" />Campaigns
        </x-nav-item>

        <x-nav-item to="{{ route('campaigns.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />Add Campaigns
        </x-nav-item>

        <x-nav-item to="{{ route('outbound') }}" class="flex items-center py-2">
            <x-icon-phone class="mr-4 text-slate-400 w-5 h-5" />Outbound Calls
        </x-nav-item>



        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Lab Management</div>

        <x-nav-item to="{{ route('items') }}" class="flex items-center py-2 truncate">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Items
        </x-nav-item>

        <x-nav-item to="{{ route('stocks') }}" class="flex items-center py-2 truncate">
            <x-icon-layer class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Stocks
        </x-nav-item>

        <x-nav-item to="{{ route('labs') }}" class="flex items-center py-2 truncate">
            <x-icon-beaker class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Labs
        </x-nav-item>

        <x-nav-item to="{{ route('fieldtestkits') }}" class="flex items-center py-2 truncate">
            <x-icon-beaker class="mr-4 text-slate-400 w-5 h-5 shrink-0" />FTK
        </x-nav-item>

        <x-nav-item to="{{ route('labDashboard') }}" class="flex items-center py-2 truncate">
            <x-icon-beaker class="mr-4 text-slate-400 w-5 h-5 shrink-0" />LMS Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('waterQualityParameters') }}" class="flex items-center py-2 truncate">
            <x-icon-droplets class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Water Quality Parameters
        </x-nav-item>

        <x-nav-item to="{{ route('transfers') }}" class="flex items-center py-2 truncate">
            <x-icon-switch-horizontal class="mr-4 text-slate-400 w-5 h-5 shrink-0" />Transfers
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Contractor Management</div>
        <x-nav-item to="{{ route('contractors') }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Contractors
        </x-nav-item>
        <x-nav-item to="{{ route('contractorGrievances') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Contractor Grievance
        </x-nav-item>
        <x-nav-item to="{{ route('contractors.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />New Contactor
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Greivence Management</div>

        <x-nav-item to="{{ route('grievanceDashboard') }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Grievance Dashboard
        </x-nav-item>
        <x-nav-item to="{{ route('categories') }}" class="flex items-center py-2">
            <x-icon-flag class="mr-4 text-slate-400 w-5 h-5" />Categories
        </x-nav-item>
        <x-nav-item to="{{ route('issues') }}" class="flex items-center py-2">
            <x-icon-setting class="mr-4 text-slate-400 w-5 h-5" />Issues
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Jal Mitra Management</div>

        <x-nav-item to="{{ route('jmDashboard') }}" class="flex items-center py-2">
            <x-icon-user class="mr-4 text-slate-400 w-5 h-5" />Jal-Mitra Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('jm.users') }}" class="flex items-center py-2">
            <x-icon-user class="mr-4 text-slate-400 w-5 h-5" />JM Users
        </x-nav-item>

        <x-nav-item to="{{ route('jm.salaries') }}" class="flex items-center py-2">
            <x-icon-rupee class="mr-4 text-slate-400 w-5 h-5" />JM Salary
        </x-nav-item>

        <x-nav-item to="{{ route('jm.notices') }}" class="flex items-center py-2">
            <x-icon-notification class="mr-4 text-slate-400 w-5 h-5" />JM Notice
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Jal Shala Management</div>

        <x-nav-item to="{{ route('districtleveltraings') }}" class="flex items-center py-2">
            <x-icon-messages class="mr-4 text-slate-400 w-5 h-5" />District TOT
        </x-nav-item>

        <x-nav-item to="{{ route('members') }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Members
        </x-nav-item>

        <x-nav-item to="{{ route('trainers.index') }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Trainers
        </x-nav-item>

        {{-- <x-nav-item to="{{ route('jalshala.dashboard') }}" class="flex items-center py-2">
			<x-icon-list class="mr-4 text-slate-400 w-5 h-5"/>Jal Shala Dashboard
		</x-nav-item>

		<x-nav-item to="{{ route('jalshalas.index') }}" class="flex items-center py-2">
			<x-icon-user class="mr-4 text-slate-400 w-5 h-5"/>Jal Shalas
		</x-nav-item> --}}

        {{-- <x-nav-item to="{{ route('jalshalas.create') }}" class="flex items-center py-2">
			<x-icon-add class="mr-4 text-slate-400 w-5 h-5"/>Add Jal Shala
		</x-nav-item> --}}

        {{-- <x-nav-item to="{{ route('jaladdas.index') }}" class="flex items-center py-2">
			<x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Jal Adda
		</x-nav-item> --}}

        <div class="text-blue-500 text-xs font-medium px-6">PHASE I</div>

        <x-nav-item to="{{ route('jalshala.dashboard', ['type' => 'phase_I']) }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Jal Shala Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('jalshalas.index', ['type' => 'phase_I']) }}" class="flex items-center py-2">
            <x-icon-user class="mr-4 text-slate-400 w-5 h-5" />Jal Shalas
        </x-nav-item>

        <x-nav-item to="{{ route('jaladdas.index', ['type' => 'phase_I']) }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Jal Adda
        </x-nav-item>

        <div class="text-blue-500 text-xs font-medium px-6">PHASE II</div>

        <x-nav-item to="{{ route('jalshala.dashboard', ['type' => 'phase_II']) }}" class="flex items-center py-2">
            <x-icon-list class="mr-4 text-slate-400 w-5 h-5" />Jal Shala Dashboard
        </x-nav-item>

        <x-nav-item to="{{ route('jalshalas.index', ['type' => 'phase_II']) }}" class="flex items-center py-2">
            <x-icon-user class="mr-4 text-slate-400 w-5 h-5" />Jal Shalas
        </x-nav-item>

        <x-nav-item to="{{ route('jaladdas.index', ['type' => 'phase_II']) }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Jal Adda
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Jal Kosh Management</div>

        <x-nav-item to="{{ route('jalkoshlinks') }}" class="flex items-center py-2">
            <x-icon-link class="mr-4 text-slate-400 w-5 h-5" />Jal Kosh Links
        </x-nav-item>

        <x-nav-item to="{{ route('reviewsections') }}" class="flex items-center py-2">
            <x-icon-setting class="mr-4 text-slate-400 w-5 h-5" />Review Sections
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Admin</div>
        <x-nav-item to="{{ route('admin.users') }}" class="flex items-center py-2">
            <x-icon-users class="mr-4 text-slate-400 w-5 h-5" />Users
        </x-nav-item>
        <x-nav-item to="{{ route('offices') }}" class="flex items-center py-2">
            <x-icon-building class="mr-4 text-slate-400 w-5 h-5" />Offices
        </x-nav-item>
        <x-nav-item to="{{ route('admin.users.create') }}" class="flex items-center py-2">
            <x-icon-add class="mr-4 text-slate-400 w-5 h-5" />New User
        </x-nav-item>
        <x-nav-item to="{{ route('banners') }}" class="flex items-center py-2">
            <x-icon-image class="mr-4 text-slate-400 w-5 h-5" />Banners
        </x-nav-item>

        <x-nav-item to="{{ route('tutorials') }}" class="flex items-center py-2">
            <x-icon-link class="mr-4 text-slate-400 w-5 h-5" />Tutorial
        </x-nav-item>

        <x-nav-item to="{{ route('backups') }}" class="flex items-center py-2">
            <x-icon-setting class="mr-4 text-slate-400 w-5 h-5" />DB Backups
        </x-nav-item>

        <div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-wider">Help Management</div>
        <x-nav-item to="{{ route('articlecategories') }}" class="flex items-center py-2">
            <x-icon-user class="mr-4 text-slate-400 w-5 h-5" />Article Categories
        </x-nav-item>
        <x-nav-item to="{{ route('articles') }}" class="flex items-center py-2">
            <x-icon-note class="mr-4 text-slate-400 w-5 h-5" />Articles
        </x-nav-item>

        <x-nav-item to="{{ route('archiveRequests') }}" class="flex items-center py-2">
            <x-icon-trash class="mr-4 text-slate-400 w-5 h-5" />Scheme Archive Requests
        </x-nav-item>


        {{-- <x-nav-item to="{{ route('classes') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-book-open class="mr-4 text-slate-400 w-5 h-5"/>Classes
		</x-nav-item>

		<x-nav-item to="{{ route('schools') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-building class="mr-4 text-slate-400 w-5 h-5"/>Schools
		</x-nav-item>

		<x-nav-item to="{{ route('subjects') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-graduation class="mr-4 text-slate-400 w-5 h-5"/>Subjects
		</x-nav-item>

		<x-nav-item to="{{ route('users') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-users class="mr-4 text-slate-400 w-5 h-5"/>Sub-administrators
		</x-nav-item>

		<x-nav-item to="{{ route('statistics') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-chart class="mr-4 text-slate-400 w-5 h-5"/>Statistics
		</x-nav-item>

		<x-nav-item to="{{ route('campaigns') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-flag class="mr-4 text-slate-400 w-5 h-5"/>Campaigns
		</x-nav-item>

		<div class="text-slate-500 text-xs font-medium px-3 mt-5 mb-1 uppercase tracking-widest">Settings</div>

		<x-nav-item to="{{ route('profile.settings') }}" class="flex items-center py-2 text-slate-200">
			<x-icon-user-edit class="mr-4 text-slate-400 w-5 h-5"/>Profile
		</x-nav-item> --}}


        {{-- <x-nav-item to="{{ route('notifications') }}" class="flex items-center py-2 text-slate-200 justify-between">
			<div class="flex items-center"><x-icon-notification class="mr-4 text-slate-400 w-5 h-5"/>Notifications</div>
			@cannot('super')
				<livewire:notifications.count />
			@endcannot
		</x-nav-item> --}}

        <div class="my-3"></div>

        <x-slot name="footer">
            <div class="px-4 py-4">

                <x-nav-item to="{{ route('changelogs') }}" target='_blank' class="flex items-center py-2">
                    <x-icon-info-circle class="mr-4 text-slate-400 w-5 h-5" />Changelogs
                </x-nav-item>

                {{-- <x-nav-item to="https://kb.phone91.com/sumato/folder/jjm" target='_blank' class="flex items-center py-2">
                    <x-icon-book-open class="mr-4 text-slate-400 w-5 h-5" />Documentation
                </x-nav-item> --}}

                {{-- <x-nav-item :active="(request()->is('docs/*')) ? true : false" to="{{ url('docs/home') }}" class="flex items-center py-2 text-slate-200">
					<x-icon-book-open class="mr-4 text-slate-400 w-5 h-5"/>Documentation
				</x-nav-item> --}}

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
