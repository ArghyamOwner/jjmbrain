<div>
    <button type="button" class="flex border-2 border-transparent rounded focus:outline-none focus:border-gray-300">
        <img 
            src="{{ auth()->user()->photo_url ?? '' }}" 
            alt="{{ auth()->user()->name ?? '' }}"
            class="h-8 w-8 rounded object-cover" 
            loading="lazy"
        />
    </button>
</div>


