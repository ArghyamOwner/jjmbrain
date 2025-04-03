<div>
    <x-card>
        <div class="mb-6">
            <x-description-list size="xs">
                <x-slot name="heading">IMIS Basic Details</x-slot>

                @if(isset($imisDetails['status']) && $imisDetails['status'] === 'success')
                <x-description-list.item>
                    <x-slot name="title">IMIS ID</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['SchemeId'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Scheme Name</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['SchemeName'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Sanction Year</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['SanctionYear'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Type</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Type'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Status</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Status'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">No Of Villages</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['NoOfVillages'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Physical Progress</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['PhysicalProgressInPercentage'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Handedover Community Status</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Handed_over_community_status'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Handedover Community Date</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Handed_over_community_date'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Category</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Category'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Workorder Date</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['WorkOrderDate'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Household Planned</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Household_planned'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">FHTC Provided</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['FHTC_provided'] }}</x-slot>
                </x-description-list.item>

                @else
                <x-card-empty variant="" class="rounded">
                    @if(isset($imisDetails['status']) && $imisDetails['status'] === 'error')
                    <p class="text-center text-slate-500 mb-3 text-sm">{{ $imisDetails['message'] }}</p>
                    @endif
                </x-card-empty>
                @endif
            </x-description-list>
        </div>
        @if(isset($imisDetails['status']) && $imisDetails['status'] === 'success')
        <div class="mb-6">
            <x-description-list size="xs">
                <x-slot name="heading">IMIS Administrative Details</x-slot>

                <x-description-list.item>
                    <x-slot name="title">District</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['DistrictId'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Block</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['BlockId'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Panchayat</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['PanchayatId'] }}</x-slot>
                </x-description-list.item>

                <x-description-list.item>
                    <x-slot name="title">Village</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['VillageId'] }}</x-slot>
                </x-description-list.item>

            </x-description-list>
        </div>
        <div class="mb-6">
            <x-description-list size="xs">
                <x-slot name="heading">IMIS Cost Details</x-slot>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Estimated Cost</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['EstimatedCost'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">CSR Donation</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['CSRDonation'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">OM Cost</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['OMCost'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['Expenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Central Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalCentralExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Central Expenditure (SC)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['CentralExpenditure_SC'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Central Expenditure (ST)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['CentralExpenditure_ST'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Central Expenditure (GEN)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['CentralExpenditure_GEN'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">State Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalStateExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">State Expenditure (SC)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['StateExpenditure_SC'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">State Expenditure (ST)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['StateExpenditure_ST'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">State Expenditure (GEN)</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['StateExpenditure_GEN'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">World Bank Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalWorldBankExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Community Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalCommunityExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">CSR Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalCSRExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>

                <x-description-list.item grid='one-by-two'>
                    <x-slot name="title">Other Expenditure</x-slot>
                    <x-slot name="description">{{ $imisDetails['data']['TotalOtherExpenditure'] }} Lakh</x-slot>
                </x-description-list.item>
            </x-description-list>
        </div>
        @endif
    </x-card>
</div>