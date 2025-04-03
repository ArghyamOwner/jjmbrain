<div>
    <x-slot name="title">All users</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top>
            <x-slot:beforeTitle>
                <x-breadcrumb class="text-lg">
                    <x-breadcrumb-item>Users</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>

            <x-slot name="action">
                @can('create', App\Models\User::class)
                    <x-button tag="a" href="{{ route('users.create') }}" color="black" with-icon icon="add">New User</x-button>   
                @endcan
            </x-slot>
        </x-navbar-top>
    </x-slot>
 
    <x-section-centered>
        <div 
            x-data="{
                errors: {},
                name: @entangle('name').defer,
                email: @entangle('email').defer,
                phone: @entangle('phone').defer,
                accounts: @entangle('accounts').defer,

                addAccount() {
                    this.accounts.push({
                        'name': '', 
                        'url': ''
                    })
                },

                hasError(field) {
                    return this.errors[field] ? true : false;
                },
                displayErrorMessage(field) {
                    return this.errors[field] ? this.errors[field][0] : '';
                },

                accountsComputed(index = null) {
                    if (index) {
                        console.log(this.accounts)
                        this.accounts = this.accounts.filter((account, accountIndex) => accountIndex != index)
                    } else {
                        return this.accounts
                    }
                }
            }"
            x-init="errors = {{ $errors }}"
            {{-- @validation-errors.window="errors = event.detail" --}}
        >
            {{-- {{ $errors  }}

             <div x-html="JSON.stringify(errors)"></div> --}}
                    
            <x-card>
                <x-card-form class="shadow-none" no-padding>
                    <x-slot name="title">Create New User</x-slot>
                    <x-slot name="description">Add a new user with role.</x-slot>

                    <div class="md:w-2/3">
                       
                        <x-input
                            label="Name" 
                            name="name"
                            x-model="name"
                        />
                        
                        <x-input
                            type="email"
                            label="Email" 
                            name="email"
                            x-model="email" 
                        />
        
                        <x-input-number
                            label="Phone" 
                            id="phone" 
                            name="phone" 
                            x-model="phone"
                            maxlength="10"
                            minlength="10"
                        />
                    </div>

                    <x-heading size="lg" class="mb-4">Your social accounts</x-heading>
                    <template x-for="(account, accountIndex) in accountsComputed()" :key="'account-' + accountIndex">
                        <div class="flex space-x-2" wire:ignore>
                            <div class="flex-1">
                                 <x-input ::name="`accounts.${accountIndex}.name`" x-model="account.name" ::value="account.name" placeholder="Twitter" />    

                                <template x-if="hasError(`accounts.${accountIndex}.name`)">
                                    <p class="text-red-600 text-sm -mt-3 mb-4" x-text="displayErrorMessage(`accounts.${accountIndex}.name`)"></p>
                                </template>
                            </div>
                            <div class="flex-1">
                                <x-input type="url" ::name="`accounts.${accountIndex}.url`"  x-model="account.url" ::value="account.url" placeholder="https://twitter.com/username" />    

                                <template x-if="hasError(`accounts.${accountIndex}.url`)">
                                    <p class="text-red-600 text-sm -mt-3 mb-4" x-text="displayErrorMessage(`accounts.${accountIndex}.url`)"></p>
                                </template>
                            </div>
                            <div>
                                <button x-show="accountIndex > 0" type="button" class="inline-block text-red-600 w-10 h-10 bg-gray-100 hover:bg-gray-50 rounded-lg" x-on:click.prevent="accountsComputed(accountIndex)">
                                    <x-icon-trash class="w-5 h-5 mx-auto text-red-500" />
                                </button>
                                <div x-show="accountIndex === 0" class="w-10 h-10"></div>
                             </div>
                        </div>
                    </template>


                    <div class="grid grid-cols-3 gap-4">
                        {{-- <x-input
                            no-margin
                            placeholder="Account Name" 
                            name="accountName"
                            x-model="accountName" 
                            required
                        />

                        <x-input
                            no-margin
                            placeholder="Account URL" 
                            name="accountUrl"
                            x-model="accountUrl" 
                            required
                        /> --}}

                        <a href="#"
                            class="text-indigo-600 hover:underline"
                            x-on:click.prevent="addAccount()"
                        >&plus; Add account</a>
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button
                        type="button"
                        color="black"
                        with-spinner
                        wire:target="save"
                        x-on:click="$wire.save()"
                    >Save</x-button>
                </x-slot>
            </x-card>
       </div>
    </x-section-centered>
</div>
