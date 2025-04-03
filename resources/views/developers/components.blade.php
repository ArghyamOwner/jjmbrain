<x-app-layout title="Developers">

    <x-slot name="secondaryTopbar">
        <x-navbar-top>
            <x-slot name="beforeTitle">
                <x-breadcrumb>
                    <x-breadcrumb-item href="{{ route('developers') }}">Developers</x-breadcrumb-item>
                    <x-breadcrumb-item>UI Components</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>
        </x-navbar-top>
    </x-slot>
 
    <x-section-centered>
        <div class="flex w-full flex-col md:flex-row md:space-x-16">
            @php
            $markdown = file_get_contents(resource_path('developers/components.md'));
            @endphp
            <div class="md:w-2/3">
                <div class="prose prose-pre:bg-white prose-pre:shadow-sm prose-pre:relative max-w-none prose-indigo">
                    {!! Str::customMarkdown($markdown) !!}
                </div>
            </div>
        </div>
    </x-section-centered>

    @once
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.4.0/styles/github.css">
    <style>
        .copy-button {
            position: absolute;
            top: 10px;
            right: 16px;
            z-index: 40;
            padding: 4px 8px;
            display: inline-flex;
            align-items: center;
            font-size: 0.75em;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            background-color: #e2e8f0;
            border-radius: 0.5em;
            font-weight: 700;
            color: #64748b;
        }

        .copy-button:hover {
            opacity: 0.75;
            color: #475569;
        }

    </style>
    @endpush
    @push('scripts-footer')
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.4.0/build/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });

            function initCopyButtons() {
                document.querySelectorAll('pre > code').forEach(function(codeBlock) {
                    let button = document.createElement('button');
                    button.className = 'copy-button';
                    button.type = 'button';
                    button.innerText = 'Copy';

                    let pre = codeBlock.parentNode;
                    pre.appendChild(button);
                });
            }
            initCopyButtons();

            let copyCode = new ClipboardJS('.copy-button', {
                target: function(trigger) {
                    return trigger.previousElementSibling;
                }
            });

            copyCode.on('success', function(event) {
                event.clearSelection();
                event.trigger.textContent = 'Copied';
                window.setTimeout(function() {
                    event.trigger.textContent = 'Copy';
                }, 2000);
            });
        });

    </script>
    @endpush
    @endonce
</x-app-layout>
