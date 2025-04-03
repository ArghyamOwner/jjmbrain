<div>
    <x-card no-padding overflow-hidden>
        @if ($users->isNotEmpty() && $showAddButton)
        <div class="p-3 border-b text-right">
            <x-button tag="a" color="blue" href="#" with-icon icon="add" x-data="{}"
                x-on:click.prevent="$dispatch('show-modal', 'assign-so-form')" x-cloak>Assign Section Officer
            </x-button>
        </div>
        @endif

        @if ($users->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Section Officer Name</x-table.thead>
                        <x-table.thead>Email | Phone</x-table.thead>
                        <x-table.thead>Subdivisions</x-table.thead>
                        @if($showDeleteButton)
                        <x-table.thead>Actions</x-table.thead>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <x-table.tdata>
                            {{ $user->name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $user->email }}
                            <p>{{ $user->phone }}</p>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $user->subdivision_names }}
                        </x-table.tdata>
                        @if($showDeleteButton)
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                <a class="text-red-500 hover:underline" href="#"
                                    onclick="confirm('Are you sure you want to remove the Section Officer ?') || event.stopImmediatePropagation()"
                                    wire:click.prevent="removeSoUser('{{ $user->id }}')">
                                    Remove
                                </a>
                            </div>
                        </x-table.tdata>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No user user found.</p>
            @if($showAddButton)
            <x-button tag="a" href="#" with-icon icon="add" x-data="{}"
                x-on:click.prevent="$dispatch('show-modal', 'assign-so-form')" x-cloak>Assign Section Officer
            </x-button>
            @endif
        </x-card-empty>
        @endif
    </x-card>


    <x-modal-simple max-width="5xl" name="assign-so-form" form-action="assignSo">
        <x-slot name="title">Assign Section Officer to Scheme</x-slot>

        <div class="mb-4 space-y-5">
            <x-alert variant="error" :close="false">
                Certainly, when assigning a new Section Officer to a scheme, it's essential to ensure that the existing
                Section Officer is properly managed. If the existing Section Officer is not assigned to the scheme, they
                should be removed from it. Here's a step-by-step process:
                <ul style="list-style-type:disc;">
                    <br />
                    <li><span class="font-bold">
                            Check Existing Assignment :
                        </span> Verify whether the existing Section Officer is currently attached to the scheme. This
                        can be done by reviewing the scheme's documentation or database records.
                    </li>
                    <br/>
                    <li><span class="font-bold">
                            If Existing Officer is assigned and a new officer is assigned as additional support to the
                            scheme :
                        </span>
                        <p>- Assign the new Section Officer (SO) to the scheme.</p>
                        <p>- If there are any handover procedures or documentation, ensure that the necessary information is transferred smoothly from the outgoing officer to the incoming one.</p>
                    </li>
                    <br/>
                    <li><span class="font-bold">
                        If Existing Officer is to changed by new officer :
                        </span>
                        <p>- Remove the existing Section Officer from the scheme's assignment list or database records.</p>
                        <p>- Notify the officer about the change in their assignment status, if necessary.</p>
                        <p>- If there are any handover procedures or documentation, ensure that the necessary information is transferred smoothly from the outgoing officer to the incoming one.</p>
                    </li>
                    <br/>
                    <li><span class="font-bold">
                        Update Records :
                        </span> Ensure that all relevant records, including personnel files and scheme documentation, are updated to reflect the changes in Section Officer assignment.
                    </li>
                    <br/>
                    <li><span class="font-bold">
                        Communication :
                        </span> Communicate the changes to all relevant stakeholders, including the new Section Officer, other team members, and supervisors, to ensure everyone is aware of the updated assignment.
                    </li>
                    <br/>
                    <li><span class="font-bold">
                        Monitoring :
                        </span> Keep an eye on the transition to ensure that the new Section Officer is effectively managing the scheme and that any issues arising from the change are promptly addressed.
                    </li>
                </ul>
                <br/>
                By following these steps, you can ensure a smooth transition when assigning a new Section Officer to the scheme and manage the removal of the existing officer if necessary.
            </x-alert>
        </div>


        <x-select label="Select Section Officer" name="user_id" wire:model.defer="user_id">
            <option value="">--Select Section Officer--</option>
            @foreach ($this->soUsers as $userKey => $userValue)
            <option value="{{ $userKey }}">{{ $userValue }}</option>
            @endforeach
        </x-select>

        <x-slot name="footer">
            <x-button type="submit" with-spinner wire:target="assignSo">Assign</x-button>
        </x-slot>
    </x-modal-simple>
</div>