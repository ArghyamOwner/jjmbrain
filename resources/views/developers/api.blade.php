<x-app-layout title="Developers">
    
    <x-slot name="secondaryTopbar">
        <x-navbar-top>
            <x-slot name="beforeTitle">
                <x-breadcrumb>
                    <x-breadcrumb-item href="{{ route('developers') }}">Developers</x-breadcrumb-item>
                    <x-breadcrumb-item>API</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>
        </x-navbar-top>
    </x-slot>

    <x-section-centered>
        <div class="flex w-full flex-col md:flex-row md:space-x-16">
            @php $markdown = file_get_contents(resource_path('developers/api.md')); @endphp
            <div class="md:w-2/3">
                <div class="prose prose-pre:bg-white prose-pre:shadow-sm prose-pre:font-mono prose-pre:text-xs prose-pre:relative prose-table:text-xs prose-td:font-mono prose-table:bg-white prose-table:rounded prose-table:shadow prose-th:bg-gray-50 prose-th:rounded-t prose-th:uppercase  prose-th:tracking-wider prose-table:rounded prose-td:px-3 prose-td:py-2 prose-th:px-3 prose-th:py-2 max-w-none prose-indigo">
                    {!! Str::customMarkdown($markdown) !!}
                </div>
            </div>
        </div>
    </x-section-centered>

    @once
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.4.0/styles/github.css">
    @endpush
    @push('scripts-footer')
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.4.0/build/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>
    @endpush
    @endonce
</x-app-layout>
