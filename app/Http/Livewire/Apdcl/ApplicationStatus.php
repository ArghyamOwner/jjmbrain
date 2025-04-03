<?php

namespace App\Http\Livewire\Apdcl;

use App\Models\ApdclSubdivisions;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ApplicationStatus extends Component
{
    public $subDiv;
    public $applNo;
    public $data;
    public $show = false;

    public function getDetail()
    {
        $validate = $this->validate([
            'applNo' => ['required'],
            'subDiv' => ['required', Rule::exists('apdcl_subdivisions', 'subdivision_id')],
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => 'YXBkY2xAcmVzdGFwaSMkJV4mXiUkI0A=',
        ])->post('https://www.apdclrms.com/restapi/v2/consumer/jjm/getApplicationStatus', [
            'applNo' => $validate['applNo'],
            'subDiv' => $validate['subDiv'],
        ]);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode != 200) {
            $this->show = false;
            return $this->notify('Something went wrong. Status Code - ' . $statusCode, 'error');
        }
        $this->show = true;
        $this->data = $responseBody;
    }

    public function getSubDivisionsProperty()
    {
        return ApdclSubdivisions::orderBy('subdivision_name')->pluck('subdivision_name', 'subdivision_id');
    }

    public function render()
    {
        return view('livewire.apdcl.application-status');
    }
}
