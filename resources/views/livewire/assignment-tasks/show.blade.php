<div>
    <x-slot name="title">Workorder Progress</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('workorders.progress', $workorderId) }}">Go back to workorder progress</x-text-link>
            </x-slot>

            <x-slot:title>
                Task Details for scheme: {{ $schemeName }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-heading size="md" class="mb-2">Details of Work for Task: {{ $assignmentTaskName }}</x-heading>
        @if (count($workorderSubtasks))
            <div class="space-y-4">
                @foreach($workorderSubtasks as $workorderSubtask)
                    <x-alertbox variant="{{ $workorderSubtask->completed_at ? 'success' : 'warning' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-description-list size="xs">
                                    <x-description-list.item>
                                        <x-slot:title>Subtask Name</x-slot>
                                        <x-slot:description>
                                            {{ $workorderSubtask->subtask->subtask_name }}
                                        </x-slot>
                                    </x-description-list.item>
        
                                    @if (! is_null($workorderSubtask->completed_at))
                                        <x-description-list.item>
                                            <x-slot:title>Submitted By</x-slot>
                                            <x-slot:description>
                                                {{ $workorderSubtask->user->name }}
                                            </x-slot>
                                        </x-description-list.item>
        
                                        <x-description-list.item>
                                            <x-slot:title>Submitted On</x-slot>
                                            <x-slot:description>
                                                {{ $workorderSubtask->completed_at?->format('d/m/Y h:i A') }}
                                            </x-slot>
                                        </x-description-list.item>

                                        <x-description-list.item>
                                            <x-slot:title>Comment</x-slot>
                                            <x-slot:description>
                                                {{ $workorderSubtask->answer }}
                                            </x-slot>
                                        </x-description-list.item>
        
                                        <x-description-list.item>
                                            <x-slot:title>Remarks</x-slot>
                                            <x-slot:description>
                                                {{ $workorderSubtask->remarks }}
                                            </x-slot>
                                        </x-description-list.item>
                                    @endif
                                </x-description-list>
                                
                                @if ($workorderSubtask->assignmentImages->isNotEmpty())
                                    <x-lightbox>
                                        <div class="mt-4 grid grid-cols-4 gap-6">
                                            @foreach($workorderSubtask->assignmentImages as $workorderSubtask->assignmentImage)
                                                <div class="rounded-lg bg-slate-100 overflow-hidden text-center">
                                                    <x-lightbox.item image-url="{{ $workorderSubtask->assignmentImage->image_url }}">
                                                        <img src="{{ $workorderSubtask->assignmentImage->image_url }}" alt="{{ $workorderSubtask->subtask->subtask_name }}" loading="lazy" class="h-24 mx-auto object-fit">
                                                    </x-lightbox.item>
                                                </div>
                                            @endforeach
                                        </div>
                                    </x-lightbox>
                                @endif
                            </div>
                            <div>
                                <x-heading size="md" class="mb-2">Reviews:</x-heading>
                               
                                @if ($workorderSubtask->assignmentReviews->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($workorderSubtask->assignmentReviews as $workorderSubtaskReview)
                                            <x-card>
                                                <x-description-list size="xs">
                                                    <x-description-list.item>
                                                        <x-slot:title>Rating</x-slot>
                                                        <x-slot:description>
                                                            {{ $workorderSubtaskReview->rating }} / 10
                                                        </x-slot>
                                                    </x-description-list.item>
        
                                                    <x-description-list.item>
                                                        <x-slot:title>Status</x-slot>
                                                        <x-slot:description>
                                                            @if ($workorderSubtaskReview->status === 'pass')
                                                                <x-badge variant="success">{{ $workorderSubtaskReview->status }}</x-badge>
                                                            @endif

                                                            @if ($workorderSubtaskReview->status === 'fail')
                                                                <x-badge variant="danger">{{ $workorderSubtaskReview->status }}</x-badge>
                                                            @endif

                                                            @if ($workorderSubtaskReview->status === 'consideration')
                                                                <x-badge variant="warning">{{ $workorderSubtaskReview->status }}</x-badge>
                                                            @endif
                                                        </x-slot>
                                                    </x-description-list.item>
        
                                                    <x-description-list.item>
                                                        <x-slot:title>Comment</x-slot>
                                                        <x-slot:description>
                                                            {{ $workorderSubtaskReview->comment }}
                                                        </x-slot>
                                                    </x-description-list.item>
        
                                                    <x-description-list.item>
                                                        <x-slot:title>Reviewed By</x-slot>
                                                        <x-slot:description>
                                                            {{ $workorderSubtaskReview->user?->name }} <span class="text-slate-500">({{ $workorderSubtaskReview->user?->role }})</span>
                                                        </x-slot>
                                                    </x-description-list.item>

                                                    <x-description-list.item>
                                                        <x-slot:title>Reviewed On</x-slot>
                                                        <x-slot:description>
                                                            @date($workorderSubtaskReview->created_at)
                                                        </x-slot>
                                                    </x-description-list.item>
        
                                                    <x-description-list.item>
                                                        <x-slot:title>Images</x-slot>
                                                        <x-slot:description>
                                                            @if (count($workorderSubtaskReview->images))
                                                                <x-lightbox>
                                                                    <div class="mt-4 grid grid-cols-3 gap-6">
                                                                        @foreach($workorderSubtaskReview->images as $reviewImage)
                                                                            <div class="rounded-lg bg-slate-100 overflow-hidden text-center">
                                                                                <x-lightbox.item image-url="{{ $reviewImage['url'] }}">
                                                                                    <img src="{{ $reviewImage['url'] }}" alt="review-image" loading="lazy" class="h-20 mx-auto object-fit">
                                                                                </x-lightbox.item>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </x-lightbox>
                                                            @endif
                                                        </x-slot>
                                                    </x-description-list.item>
                                                </x-description-list>
                                            </x-card>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-slate-400">No review yet.</p>
                                @endif
                            </div>
                        </div>
                    </x-alertbox>
                @endforeach

            </div>
        @else
            <x-card-empty />
        @endif
    </x-section-centered>
</div>
