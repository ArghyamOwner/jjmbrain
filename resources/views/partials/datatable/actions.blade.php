<div class="space-x-2 inline-flex">
	@if (count($edit))
		<a href="{{ $edit[0] }}" class="text-sky-600 hover:underline">Edit</a>
	@endif
	
	@if (count($destroy))
		<a href="#" 
			x-data="{}" 
			x-on:click.prevent="$wire.emitTo(
				'delete-modal',
				'showDeleteModal',
				'{{ $destroy[0] ?? '' }}',
				'{{ $destroy[1] ?? '' }}',
				'{{ $destroy[2] ?? '' }}',
				'{{ $destroy[3] ?? '' }}'
			)"
			class="text-red-600 hover:underline"
		>Delete</a>
	@endif
</div>
 