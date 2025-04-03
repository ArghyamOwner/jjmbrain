<div>
    <x-slot name="title">Scheme Item-Wise Progress</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Create Scheme Item-Wise Progress
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>

            @if ($preliminaryWorkorderUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Preliminary Workorder</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold col-span-2">Updated by {{ $preliminaryWorkorderUser }}, on {{
                            $preliminaryWorkorderDate }}</div>
                        <div class="text-right">
                            {{-- <x-button color="red" with-spinner wire:click="removee">Delete</x-button> --}}
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the Preliminary Workorder data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('preliminary_workorder')" type="button">Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card card-classes="mt-4" form-action="savePreliminaryWorkorder">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Preliminary Workorder Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Preliminary Workorder" name="preliminary_workorder" wire:model.defer="preliminary_workorder" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Preliminary Workorder Date" name="preliminary_workorder_date" wire:model.defer="preliminary_workorder_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="savePreliminaryWorkorder">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($preliminaryActivitiesUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Preliminary Activities</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold col-span-2">Updated by {{ $preliminaryActivitiesUser }}, on {{
                            $preliminaryActivitiesDate }}</div>
                        <div class="text-right">
                            {{-- <x-button color="red" with-spinner wire:click="removee">Delete</x-button> --}}
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the preliminary activities data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('preliminary_activities')" type="button">Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card card-classes="mt-4" form-action="savePreliminaryActivities">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Preliminary Activities Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Preliminary Activities" name="preliminary_activities" wire:model.defer="preliminary_activities" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Preliminary Activites Date" name="preliminary_activities_date" wire:model.defer="preliminary_activities_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="savePreliminaryActivities">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($formalWorkorderUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Formal Workorder</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold col-span-2">Updated by {{ $formalWorkorderUser }}, on {{
                            $formalWorkorderDate }}</div>
                        <div class="text-right">
                            {{-- <x-button color="red" with-spinner wire:click="removee">Delete</x-button> --}}
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the Formal Workorder data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('formal_workorder')" type="button">Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card card-classes="mt-4" form-action="saveFormalWorkorder">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Formal Workorder Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Formal Workorder" name="formal_workorder" wire:model.defer="formal_workorder" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Formal Workorder Date" name="formal_workorder_date" wire:model.defer="formal_workorder_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveFormalWorkorder">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($sourceUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Source</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold col-span-2">Updated by {{ $sourceUser }}, on {{
                            $sourceDate }}</div>
                        <div class="text-right">
                            {{-- <x-button color="red" with-spinner wire:click="removee">Delete</x-button> --}}
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the source data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('source')" type="button">Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card card-classes="mt-4" form-action="saveSource">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Source Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Source" name="source" wire:model.defer="source" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Source Date" name="source_date" wire:model.defer="source_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveSource">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($tpUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">TP</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $tpUser }}, on {{ $tpDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the TP data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('tp')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveTp" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">TP Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="TP" name="tp" wire:model.defer="tp" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="TP Date" name="tp_date" wire:model.defer="tp_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveTp">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($ugrUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">UGR</x-heading>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $ugrUser }}, on {{ $ugrDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the UGR data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('ugr')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveUgr" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">UGR Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="UGR" name="ugr" wire:model.defer="ugr" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="UGR Date" name="ugr_date" wire:model.defer="ugr_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveUgr">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($esrUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">ESR</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $esrUser }}, on {{ $esrDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the ESR data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('esr')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveEsr" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">ESR Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="ESR" name="esr" wire:model.defer="esr" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="ESR Date" name="esr_date" wire:model.defer="esr_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveEsr">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($pumpHouseUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Pump House</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $pumpHouseUser }}, on {{ $pumpHouseDate
                            }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the pump house data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('pump_house')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="savePumpHouse" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Pump House Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Pump House" name="pump_house" wire:model.defer="pump_house"
                            default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Pump House Date" name="pump_house_date"
                            wire:model.defer="pump_house_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="savePumpHouse">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($apdclUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">APDCL</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $apdclUser }}, on {{ $apdclDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the APDCL data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('apdcl')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveApdcl" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">APDCL Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="APDCL" name="apdcl" wire:model.defer="apdcl" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="APDCL Date" name="apdcl_date" wire:model.defer="apdcl_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveApdcl">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($internalConnectionUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Internal Connection</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $internalConnectionUser }}, on
                            {{ $internalConnectionDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the internal connection data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('internal_connection')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveInternalConnection" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Internal Connection Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Internal Connection" name="internal_connection"
                            wire:model.defer="internal_connection" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Internal Connection Date" name="internal_connection_date"
                            wire:model.defer="internal_connection_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveInternalConnection">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($genSetUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Gen Set</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $genSetUser }}, on {{ $genSetDate }}
                        </div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the gen set data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('gen_set')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveGenSet" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Gen Set Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Gen Set" name="gen_set" wire:model.defer="gen_set" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Gen Set Date" name="gen_set_date" wire:model.defer="gen_set_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveGenSet">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($ldsUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">LDS</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $ldsUser }}, on {{ $ldsDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the LDS data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('lds')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveLds" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">LDS Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="LDS" name="lds" wire:model.defer="lds" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="LDS Date" name="lds_date" wire:model.defer="lds_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveLds">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($siteDevelopmentUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Site Development</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $siteDevelopmentUser }}, on
                            {{ $siteDevelopmentDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the site development data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('site_development')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveSiteDevelopment" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Site Development Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Site Development" name="site_development"
                            wire:model.defer="site_development" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Site Development Date" name="site_development_date"
                            wire:model.defer="site_development_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveSiteDevelopment">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($boundaryWallUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Boundary Wall</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $boundaryWallUser }}, on
                            {{ $boundaryWallDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the boundary wall data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('boundary_wall')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveBoundaryWall" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Boundary Wall Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Boundary Wall" name="boundary_wall" wire:model.defer="boundary_wall"
                            default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Boundary Wall Date" name="boundary_wall_date"
                            wire:model.defer="boundary_wall_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveBoundaryWall">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($paintingUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Painting</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $paintingUser }}, on {{ $paintingDate }}
                        </div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the painting data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('painting')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="savePainting" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Painting Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="Painting" name="painting" wire:model.defer="painting" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="Painting Date" name="painting_date"
                            wire:model.defer="painting_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="savePainting">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($rwpUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">RWP</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $rwpUser }}, on {{ $rwpDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the RWP data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('rwp')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveRwp" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">RWP Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>
                    <div class="w-96 float-right">
                        <x-radio-group label="RWP" name="rwp" wire:model.defer="rwp" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />
                        <x-input type="date" label="RWP Date" name="rwp_date" wire:model.defer="rwp_date" />
                    </div>
                </x-card-form>
                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>
                    <x-button with-spinner wire:target="saveRwp">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($cwpUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">CWP</x-heading>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $cwpUser }}, on {{ $cwpDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the CWP data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('cwp')" type="button">
                                Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card form-action="saveCwp" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">CWP Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="CWP" name="cwp" wire:model.defer="cwp" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="CWP Date" name="cwp_date" wire:model.defer="cwp_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveCwp">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($networkUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Network</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $networkUser }}, on {{ $networkDate }}
                        </div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the network data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('network')" type="button">
                                Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card form-action="saveNetwork" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Network Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Network" name="network" wire:model.defer="network" default-value="no"
                            :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Network Date" name="network_date" wire:model.defer="network_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveNetwork">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($fhtcUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">FHTC</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $fhtcUser }}, on {{ $fhtcDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the FHTC data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('fhtc')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveFhtc" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">FHTC Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="FHTC" name="fhtc" wire:model.defer="fhtc" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="fhtc Date" name="fhtc_date" wire:model.defer="fhtc_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveFhtc">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($trialRunUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Completion of Trial Run</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $trialRunUser }}, on {{ $trialRunDate }}
                        </div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the trial run data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('trial_run')" type="button">
                                Delete</x-button>
                        </div>
                    </div>

            </x-card>
            @else
            <x-card form-action="saveTrialRun" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Completion of Trial Run Details</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Trail Run Completion" name="trial_run" wire:model.defer="trial_run"
                            default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Completion Date" name="trial_run_date"
                            wire:model.defer="trial_run_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveTrialRun">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($workCompletionUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">100% Work Completion</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $workCompletionUser }}, on {{
                            $workCompletionDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the work completion data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('work_completion')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveWorkCompletion" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">100% Work Completion</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="100% Work Completion" name="work_completion"
                            wire:model.defer="work_completion" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Completion Date" name="work_completion_date"
                            wire:model.defer="work_completion_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveWorkCompletion">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($schemeHandoverUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500">Handover of Scheme</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $schemeHandoverUser }}, on {{
                            $schemeHandoverDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the scheme handover data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('scheme_handover')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="saveSchemeHandover" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Handover of Scheme</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label="Handover of Scheme" name="scheme_handover"
                            wire:model.defer="scheme_handover" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Handover Date" name="scheme_handover_date"
                            wire:model.defer="scheme_handover_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="saveSchemeHandover">Save</x-button>
                </x-slot>
            </x-card>
            @endif

            @if ($panchayatVerifiedUser)
            <x-card card-classes="mt-4">
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg" class="text-blue-500"> Verified by panchayat</x-heading>
                    </x-slot>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-blue-500 font-semibold">Updated by {{ $panchayatVerifiedUser }}, on {{
                            $panchayatVerifiedDate }}</div>
                        <div class="text-right">
                            <x-button color="red"
                                onclick="confirm('Are you sure you want to remove the panchayat verified data?') || event.stopImmediatePropagation()"
                                wire:click="removeData('panchayat_verified')" type="button">
                                Delete</x-button>
                        </div>
                    </div>
            </x-card>
            @else
            <x-card form-action="savePanchayatVerified" card-classes="mt-4">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title"> Verified by panchayat</x-slot>
                    <x-slot name="description">Add the necessary details.</x-slot>

                    <div class="w-96 float-right">
                        <x-radio-group label=" Verified by panchayat" name="panchayat_verified"
                            wire:model.defer="panchayat_verified" default-value="no" :options="[
                                [
                                    'label' => 'Yes',
                                    'value' => 'yes',
                                ],
                                [
                                    'label' => 'No',
                                    'value' => 'no',
                                ],
                            ]" />

                        <x-input type="date" label="Handover Date" name="panchayat_verified_date"
                            wire:model.defer="panchayat_verified_date" />
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="savePanchayatVerified">Save</x-button>
                </x-slot>
            </x-card>
            @endif

        </x-section-centered>
</div>