<div>
	<x-section-container-styled
		heading="Tenders"
		subheading="The news about latest tenders uploaded."
	/>
 
	<div class="pt-10 pb-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4">
            @if($tenders->isNotEmpty()) 
				<div class="mb-8 space-y-6">	
					@foreach($tenders as $tender)
						<x-card card-classes="py-4" overflow-hidden>
                            @if ($tender->is_tender_new)
                                <div class="rounded-l-full absolute z-10 top-2 right-0 bg-orange-500 text-white px-4">New</div>
                                <div class="rounded-l-full absolute top-3 -right-px bg-orange-200 text-white px-4">New</div>
                            @endif

                            <div class="mb-4 grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                                <div>
                                    <h2 class="uppercase tracking-wider text-xs mb-1 font-semibold text-slate-800">Publish Date</h2>
                                    <p class="text-slate-600">@date($tender->publish_date)</p>
                                </div>
                                <div>
                                    <h2 class="uppercase tracking-wider text-xs mb-1 font-semibold text-slate-800">Due Date</h2>
                                    <p class="text-slate-600">@date($tender->due_date)</p>
                                </div>
                                <div>
                                    <h2 class="uppercase tracking-wider text-xs mb-1 font-semibold text-slate-800">Tender No.</h2>
                                    <p class="text-slate-600">{{ $tender->tender_no }}</p>
                                </div>
                            </div>

                            <x-heading size="xl">{{ $tender->name }}</x-heading>

                            @if ($tender->tenderdocuments->isNotEmpty())
                                <div class="border rounded-lg divide-y bg-white mt-4">
                                    @foreach($tender->tenderdocuments as $tenderdocument)
                                        <div class="flex items-center justify-around px-4 py-2">
                                            <div class="flex-1 font-medium text-slate-700 pr-2">{{ $tenderdocument->document_type }}</div>
                                            <div>
                                                <x-text-link href="{{ $tenderdocument->document_url }}" download>Download</x-text-link>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </x-card>
					@endforeach
				</div>

				<div class="my-6">
					{{ $tenders->links() }}
				</div>
            @else
                <x-card-empty>
                    No tenders uploaded yet.
                </x-card-empty>
			@endif
        </div>
    </div> 
</div>
