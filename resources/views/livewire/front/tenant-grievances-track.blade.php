<div>
	<x-section-container-styled
		heading="Track your grievance"
	>
        <div>
            <form wire:submit.prevent="trackGrievance">
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin name="search" wire:model.defer="search" class="w-full" placeholder="grievance number" />
                    </div>
                    <x-button color="white" class="text-sky-700" with-spinner>Track status</x-button>
                </div>
            </form>
            <x-text-link href="{{ route('tenant.grievances') }}" color="blue-light" class="mt-3"><x-icon-add class="w-5 h-5" />Submit new Grievance</x-text-link>
        </div>
    </x-section-container-styled>
 
	<div class="py-10 bg-slate-50">
        <x-section-centered>
            <div class="max-w-4xl mx-auto"> 
                @if ($result)
                    <x-card>
                        <x-heading class="mb-4">Result found:</x-heading>
                        <x-table.table :with-shadow="false" table-bordered>
                            <tbody>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Tracking No.</x-table.tdata>
                                    <x-table.tdata class="font-mono">{{ $trackingNumber }}</x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Name</x-table.tdata>
                                    <x-table.tdata>{{ $name }}</x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Phone</x-table.tdata>
                                    <x-table.tdata class="font-mono">{{ $phone }}</x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Service Type</x-table.tdata>
                                    <x-table.tdata>{{ $serviceType }}</x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Title</x-table.tdata>
                                    <x-table.tdata>{{ $title }}</x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Status</x-table.tdata>
                                    <x-table.tdata>
                                        <x-badge variant="{{ $statusColor }}">{{ $status }}</x-badge>
                                    </x-table.tdata>
                                </tr>
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Submitted on</x-table.tdata>
                                    <x-table.tdata>{{ $submittedOn }}</x-table.tdata>
                                </tr>
                                @if ($comment)
                                <tr>
                                    <x-table.tdata class="font-bold uppercase tracking-wider text-xs text-slate-600">Comment</x-table.tdata>
                                    <x-table.tdata>{{ $comment }}</x-table.tdata>
                                </tr>
                                @endif
                            </tbody>
                        </x-table.table>
                    </x-card>
                @else
                    <x-card-empty>
                        No result found.
                    </x-card-empty>
                @endif
            </div>
        </x-section-centered>
    </div> 
</div>
