<div>
    @if ($comments->isEmpty())
    <x-card-empty variant="">
        <p class="text-center text-slate-500 mb-3 text-sm">No comment found.</p>
    </x-card-empty>

    @else

    @foreach ($comments as $key => $comment)
    <x-timeline :last="$loop->last">
        <x-slot name="title">{{ $comment->commentedBy?->name }} <x-badge variant="{{ $comment->status_color }}">{{ $comment->status }}</x-badge></x-slot>
        <x-slot name="subtitle">{{ $comment->created_at->diffForHumans() }}</x-slot>

        {{ $comment['body'] }}

        @if($comment->attachment)
        <div class="mt-2 flex space-x-4">
            <x-text-link href="{{ $comment->attachment_url }}" target="_blank" class="font-medium">
                <x-icon-download class="pr-2" /> File
            </x-text-link>
        </div>
        @endif
    </x-timeline>
    @endforeach
    @endif
</div>