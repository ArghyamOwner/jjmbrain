<?php

namespace App\Http\Livewire\Schemes;

use App\Models\ContractorDetail;
use App\Models\Scheme;
use App\Models\Workdocument;
use App\Models\Workorder;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FetchSmtWorkorder extends Component
{
    use InteractsWithBanner;

    public $smtId;
    public $scheme;
    public $schemeId;
    public $schemeName;
    public $brainWorkorders;

    public function mount(Scheme $schemeId)
    {
        $this->schemeId = $schemeId->id;
        $this->smtId = $schemeId->old_scheme_id;
        $this->schemeName = $schemeId->name;
        $this->scheme = $schemeId->load('workorders.contractor.contractor', 'division');
        $this->brainWorkorders = $this->scheme->workorders;
    }

    public function fetchWorkorder()
    {
        $apiURL = "https://jjmassam.in/crs/api/getWorkOrderDetails/$this->smtId";
        $response = Http::withBasicAuth(config('services.jjmAssam.username'), config('services.jjmAssam.password'))
        ->withHeaders([
            "APIKEY" => config('services.jjmAssam.api_key'),
        ])->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    public function updateDataFromSmt()
    {
        $data = $this->fetchWorkorder();
        $contractorFound = ContractorDetail::withWhereHas('user')
            ->where('bid_no', $data['workorder']['contractor_bid'])
            ->first();

        if (!$contractorFound) {
            return $this->notify('Contractor Not Found', 'error');
        }

        $updateData = [
            'old_workorder_id' => $data['workorder']['workOrderId'],
            'issuing_authority' => $data['workorder']['issuingAuthority'],
            'contractor_id' => $contractorFound?->user?->id,
            'workorder_number' => $data['workorder']['workorder_number'],
            'workorder_amount' => $data['workorder']['workorder_amount'],
            'workorder_estimated_date' => $data['workorder']['workorder_estimated_date'],
            'pg_status' => $data['workorder']['pg_status'],
            'workorder_status' => $data['workorder']['workorder_status'],
            'formal_workorder_number' => $data['workorder']['formal_workorder_number'],
            'formal_workorder_date' => $data['workorder']['formal_workorder_date'],
            'formal_workorder_amount' => $data['workorder']['formal_workorder_amount'],
            'ts_amount' => $data['workorder']['ts_amount'],
            // 'ts_document' => $data['workorder']['ts_document']
        ];

        if ($this->brainWorkorders->isNotEmpty()) {
            $this->brainWorkorders->toQuery()->update($updateData);
        } else {
            $workorder = Workorder::create([
                'old_workorder_id' => $data['workorder']['workOrderId'],
                'issuing_authority' => $data['workorder']['issuingAuthority'],
                'contractor_id' => $contractorFound?->user?->id,
                'division_id' => $this->scheme->division_id,
                'workorder_number' => $data['workorder']['workorder_number'],
                'circle_id' => $this->scheme?->division?->circle_id,
                'workorder_amount' => $data['workorder']['workorder_amount'],
                'workorder_type' => 'work',
                'workorder_status' => 'ongoing',
                'workorder_estimated_date' => $data['workorder']['workorder_estimated_date'],
                'formal_workorder_date' => $data['workorder']['formal_workorder_date'],
                'formal_workorder_number' => $data['workorder']['formal_workorder_number'],
                'formal_workorder_amount' => $data['workorder']['formal_workorder_amount'],
                'ts_amount' => $data['workorder']['ts_amount'],
                // 'ts_document' =>
                'pg_status' => $data['workorder']['pg_status'],
            ]);

            // if ($data['workorder']['ts_document']) {
            if (isset($data['workorder']['ts_document']) && $data['workorder']['ts_document']) {

                $imageUrl = $data['workorder']['ts_document'];

                // Get the file name and extension
                $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
                $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);

                // Get the file size
                $headers = get_headers($imageUrl, true);
                $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;

                $originalName = $fileName . '.' . $extension;

                $fileContents = file_get_contents($imageUrl);
                Storage::disk('workorderdocs')->put($originalName, $fileContents);

                Workdocument::create([
                    'workorder_id' => $workorder->id,
                    'name' => $fileName,
                    'path' => $originalName,
                    'size' => $fileSize,
                    'extension' => $extension,
                ]);

            }
            $workorder->update([
                'ts_document' => $originalName ?? null,
            ]);

            $this->scheme->workorders()->sync($workorder);

        }
        $this->banner('Data updated successfully.');
        return redirect()->route('fetch.smtWorkorder', $this->schemeId);
    }

    public function render()
    {
        return view('livewire.schemes.fetch-smt-workorder', [
            'workorderDetails' => $this->fetchWorkorder(),
        ]);
    }
}
