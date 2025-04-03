<x-guest-layout>
    <div class="absolute right-0" id="google_translate_element"></div>
    <div class="px-4 py-4" style="background-color: #0f4497;">
        <div class="flex justify-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-16">
            </div>
            <div class="text-left">
                <div class="text-2xl font-bold text-white">Jal Jeevan Mission</div>
                <div class="text-xl font-medium text-white">PHED Assam</div>
            </div>
        </div>
    </div>

    <div class="px-4 py-8" style="background-color: #056fd2;">
        <div>
            <img src="{{ url('img/emblem.png') }}" alt="emblem" loading="lazy" class="object-fit h-32 mx-auto block">
            <div class="uppercase text-md tracking-wider text-center font-medium text-white">GOVERNMENT OF ASSAM</div>
        </div>

        <div class="text-lg font-medium text-white text-center">
            Public Health Engineering Department <br>
        </div>
    </div>

    <x-section-centered class="py-4">

        <div class="border rounded-lg bg-slate-800 p-10 my-6">
            <p class="text-2xl text-white mb-4 text-center font-semibold">Submit your grievance through:</p>
            <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">

                <x-button class="bg-green-600 hover:bg-green-700 py-3 text-lg w-full" target="_blank" tag="a"
                    href="http://wa.me/917086041396">
                    Option 1 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.403 5.633A8.919 8.919 0 0 0 12.053 3c-4.948 0-8.976 4.027-8.978 8.977 0 1.582.413 3.126 1.198 4.488L3 21.116l4.759-1.249a8.981 8.981 0 0 0 4.29 1.093h.004c4.947 0 8.975-4.027 8.977-8.977a8.926 8.926 0 0 0-2.627-6.35m-6.35 13.812h-.003a7.446 7.446 0 0 1-3.798-1.041l-.272-.162-2.824.741.753-2.753-.177-.282a7.448 7.448 0 0 1-1.141-3.971c.002-4.114 3.349-7.461 7.465-7.461a7.413 7.413 0 0 1 5.275 2.188 7.42 7.42 0 0 1 2.183 5.279c-.002 4.114-3.349 7.462-7.461 7.462m4.093-5.589c-.225-.113-1.327-.655-1.533-.73-.205-.075-.354-.112-.504.112s-.58.729-.711.879-.262.168-.486.056-.947-.349-1.804-1.113c-.667-.595-1.117-1.329-1.248-1.554s-.014-.346.099-.458c.101-.1.224-.262.336-.393.112-.131.149-.224.224-.374s.038-.281-.019-.393c-.056-.113-.505-1.217-.692-1.666-.181-.435-.366-.377-.504-.383a9.65 9.65 0 0 0-.429-.008.826.826 0 0 0-.599.28c-.206.225-.785.767-.785 1.871s.804 2.171.916 2.321c.112.15 1.582 2.415 3.832 3.387.536.231.954.369 1.279.473.537.171 1.026.146 1.413.089.431-.064 1.327-.542 1.514-1.066.187-.524.187-.973.131-1.067-.056-.094-.207-.151-.43-.263">
                        </path>
                    </svg>Whatsapp
                </x-button>

                <x-button class="bg-yellow-600 hover:bg-yellow-700 py-3 text-lg w-full" tag="a"
                    href="tel:+917099098444">
                    Option 2 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M17.707 12.293a.999.999 0 0 0-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 0 0 0-1.414l-4-4a.999.999 0 0 0-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 0 0 0-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 0 0-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 0 0 .912-.271L17 14.414 19.586 17l-2.006 2.005z">
                        </path>
                    </svg>Phone
                </x-button>

                <x-button color="red" class="py-3 text-lg w-full" tag="a" href="{{ route('grievance') }}">
                    Option 3 :
                    <svg class="fill-current text-white mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M20 2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h3v3.766L13.277 18H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14h-7.277L9 18.234V16H4V4h16v12z">
                        </path>
                        <circle cx="15" cy="10" r="2"></circle>
                        <circle cx="9" cy="10" r="2"></circle>
                    </svg>
                    Online
                </x-button>
            </div>
        </div>

        <div class="border rounded-lg bg-gray-200 p-10 my-6 text-center">
            You can follow us on:
            <div class="flex space-x-10 justify-center">
                <a class="w-20 h-20" href="https://www.facebook.com/assamjaljeevanmission/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #1877f2;">
                        <path
                            d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                        </path>
                    </svg>
                </a>

                <a class="w-20 h-20" href="https://www.instagram.com/jaljeevanmissionassam/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #405de6;">
                        <path
                            d="M20.947 8.305a6.53 6.53 0 0 0-.419-2.216 4.61 4.61 0 0 0-2.633-2.633 6.606 6.606 0 0 0-2.186-.42c-.962-.043-1.267-.055-3.709-.055s-2.755 0-3.71.055a6.606 6.606 0 0 0-2.185.42 4.607 4.607 0 0 0-2.633 2.633 6.554 6.554 0 0 0-.419 2.185c-.043.963-.056 1.268-.056 3.71s0 2.754.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.043 1.268.056 3.71.056s2.755 0 3.71-.056a6.59 6.59 0 0 0 2.186-.419 4.615 4.615 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.187.043-.962.056-1.267.056-3.71-.002-2.442-.002-2.752-.058-3.709zm-8.953 8.297c-2.554 0-4.623-2.069-4.623-4.623s2.069-4.623 4.623-4.623a4.623 4.623 0 0 1 0 9.246zm4.807-8.339a1.077 1.077 0 0 1-1.078-1.078 1.077 1.077 0 1 1 2.155 0c0 .596-.482 1.078-1.077 1.078z">
                        </path>
                        <circle cx="11.994" cy="11.979" r="3.003"></circle>
                    </svg>
                </a>

                <a class="w-20 h-20" href="https://twitter.com/JJM_Assam" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: #1da1f2;">
                        <path
                            d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </x-section-centered>
</x-guest-layout>