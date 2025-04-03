<div>
    <div    
        x-on:show-rating.window="showModal"
        x-data="{ 
            id: '{{ $schemeId }}',
            open: false,
            dismissed: false,
            ratingGiven: false, 
            dismissModal() {
                this.dismissed = true;
                localStorage.setItem('ratingDismissed_' + this.id, 'true');
                this.hideModal();
            },
            hideModal() {
                this.open = false;
            },
            showModal() {

                const ratingDismissed = localStorage.getItem('ratingDismissed_' + this.id);
                const ratingGiven = localStorage.getItem('ratingGiven_' + this.id);
                
                if (!ratingDismissed && !ratingGiven) {
                    this.open = true;
                }
            },
            rating: 0,
            hoverRating: 0,
            ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
            rate(amount) {
                if (this.rating == amount) {
                    this.rating = 0;
                }
                else this.rating = amount;

                $wire.save(this.rating ?? 0)

                this.ratingGiven = true;
                localStorage.setItem('ratingGiven_' + this.id, 'true');
            },
            currentLabel() {
                let r = this.rating;
                if (this.hoverRating != this.rating) r = this.hoverRating;
                let i = this.ratings.findIndex(e => e.amount == r);
                if (i >=0) {return this.ratings[i].label;} else {return ''};     
            }
        }" x-init="() => {
        
    }" x-cloak>
        <div x-show="open"     
              x-transition:enter-start="opacity-0 scale-90" 
              x-transition:enter="transition duration-200 transform ease"
              x-transition:leave="transition duration-200 transform ease"
              x-transition:leave-end="opacity-0 scale-90"
               class="max-w-screen h-screen mx-auto fixed inset-0 p-5 bottom-40 rounded-lg drop-shadow-2xl flex gap-4 flex-wrap md:flex-nowrap text-center md:text-left items-center justify-center md:justify-between">

            {{-- Overlay --}}
            <div class="fixed inset-0 z-40 bg-slate-600 opacity-75 pointer-events-none transition-opacity ease-linear duration-300" x-cloak></div>

          <div class="flex w-full justify-center items-center relative z-50">
            <div class="flex flex-col items-center justify-center space-y-2 rounded m-2 w-72 h-56 p-3 bg-white mx-auto z-50 relative opacity-100">

                <button type="button" type="submit" x-on:click.prevent="open = !open" class="border flex items-center justify-center absolute top-0 right-0 mt-2 mr-2 w-8 h-8 rounded-md bg-white hover:bg-gray-200">
                    <svg class="w-5 h-5 mx-auto text-slate-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                </button>

                @if ($isSchemeRated)
                    <div class="p-2">
                         <x-heading size="xl" class="mb-3">Thanks for your valuable rating!</x-heading>

                         <p class="mb-6">You can again rate this scheme after 7 days.</p>

                         <x-button type="button" color="white" class="w-full" x-on:click="dismissModal()">Dismiss</x-button>
                    </div>
                @else
                    <x-heading class="mb-5 py-4 px-10">How satisfied are you with the scheme?</x-heading>
                    <div class="flex space-x-0">
                        <template x-for="(star, index) in ratings" :key="index">
                            <button @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
                                aria-hidden="true"
                                :title="star.label"
                                class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer"
                                :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                                <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        </template>
                    </div>

                    <div class="p-2">
                        <template x-if="rating || hoverRating">
                            <p x-text="currentLabel()"></p>
                        </template>
                        <template x-if="!rating && !hoverRating">
                            <p>Please Rate!</p>
                        </template>
                    </div>
                @endif
            </div>

          </div>
        </div>
    </div>
</div>
