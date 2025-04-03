@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'bg-red-100 p-3 rounded-lg']) }}>
        <ul class="list-unstyled text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
