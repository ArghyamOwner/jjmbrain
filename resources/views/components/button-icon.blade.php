<a href="{{ $href ?? '#' }}" role="button" {{ $attributes->merge(['class' => 'w-8 h-8 rounded-lg hover:bg-gray-100 text-gray-500 inline-flex items-center justify-center']) }}>
	{{ $slot }}
</a>
 
