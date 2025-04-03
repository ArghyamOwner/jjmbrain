<div>
    <x-slot name="title">Survey</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('outbound') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Survey
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card card-classes="mb-8">
            <x-description-list size="xs">
                {{-- <x-description-list.item>
                    <x-slot name="title">Division Name</x-slot>
                    <x-slot name="description">
                        {{ $divisionName }}
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Scheme Name</x-slot>
                    <x-slot name="description">
                        {{ $schemeName }}
                    </x-slot>
                </x-description-list.item> --}}

                <x-description-list.item>
                    <x-slot name="title">Name</x-slot>
                    <x-slot name="description">
                        {{ $userName }}
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Email</x-slot>
                    <x-slot name="description">
                        {{ $userEmail }}
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Phone</x-slot>
                    <x-slot name="description">
                        {{ $userPhone }}
                    </x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Role</x-slot>
                    <x-slot name="description">
                        {{ $userRole }}
                    </x-slot>
                </x-description-list.item>
            </x-description-list>
        </x-card>

        <x-card form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Survey Details</x-slot>
                <x-slot name="description">Please make sure that you have all the correct information for adding a
                    details.</x-slot>

                @foreach ($this->questions as $question)
                <x-select label="{{ $question->question }}" name="answer.{{ $question->question }}"
                    wire:model.defer="answer.{{ $question->question }}">
                    <option value="" selected>Please Select</option>
                    <option value="{{ $question->option_1 }}">{{ $question->option_1 }}</option>
                    <option value="{{ $question->option_2 }}">{{ $question->option_2 }}</option>
                    @if($question->option_3)
                    <option value="{{ $question->option_3 }}">{{ $question->option_3 }}</option>
                    @endif
                    @if($question->option_4)
                    <option value="{{ $question->option_4 }}">{{ $question->option_4 }}</option>
                    @endif
                </x-select>
                @endforeach
                
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>
    
                <x-button
                    type="submit"
                    with-spinner
                    wire:target="save"
                >Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>