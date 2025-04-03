<div>
    <x-slot name="title">Edit Class</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('classes') }}">Back to classes</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Class
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save" card-classes="mb-8">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Class</x-slot>

                <x-input label="Class Display Name" name="className" wire:model.defer="className" />
                {{-- <x-select label="Class Grade" name="classGrade" wire:model.defer="classGrade">
                    <option value="">--Select Grade--</option>
                    @foreach($this->allClasses as $allClass)
                        <option value="{{ $allClass->class_grade }}">{{ $allClass->class_grade }}</option>
                    @endforeach
                </x-select> --}}
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

        <x-card form-action="saveSubjects">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Subjects</x-slot>
                <x-slot name="description">Add the subjects that correspond to each class.</x-slot>
                <x-component-listbox
                    multiple
                    label="Subjects" 
                    name="subjects"
                    wire:model="subjects"
                    :options="$this->allSubjects"
                >
                    <x-slot name="custom">
                        <template x-if="Object.keys(options).length > 0">
                            <div class="px-4 py-2 hover:bg-slate-100 rounded-lg hover:text-indigo-600">
                                <div class="text-slate-700 font-medium" x-text="option.label"></div>
                                <div class="text-sm text-slate-500" x-text="option?.description"></div>
                            </div>
                        </template>
                    </x-slot>
                </x-component-listbox>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="saveSubjects">Save</x-button>
            </x-slot>
        </x-card>

        <x-section-border />

        <livewire:classes.milestones :class-id="$classId" />

    </x-section-centered>
    
</div>
