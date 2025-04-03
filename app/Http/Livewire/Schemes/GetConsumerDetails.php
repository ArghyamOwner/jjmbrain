<?php

namespace App\Http\Livewire\Schemes;

use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GetConsumerDetails extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $schemeConsumerNo;
    public $month;
    public $year;
    public $data;

    protected $listeners = [
        'consumerDetailsSlideover' => 'openModal',
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->schemeConsumerNo = $id;
    }

    public function getDetails()
    {
        $validatedData = $this->validate([
            'month' => ['required'],
            'year' => ['required'],
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => 'YXBkY2xAcmVzdGFwaSMkJV4mXiUkI0A=',
        ])->post('https://www.apdclrms.com/restapi/v2/consumer/jjm/getConsumerDetails', [
            'consNo' => $this->schemeConsumerNo,
            'month' => $validatedData['month'],
            'year' => $validatedData['year'],
        ]);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode != 200) {
            $this->show = false;
            return $this->notify('Something went wrong. Status Code - ' . $statusCode, 'error');
        }

        $this->data = $responseBody;

        // dd($responseBody);

        // [ // app/Http/Livewire/Schemes/GetConsumerDetails.php:54
        //     "errorCode" => "404",
        //     "consNo" => "13201008423",
        //     "status" => "failed",
        //     "errorMsg" => "Consumer not found in APDCL system",
        // ];

        // [ // app/Http/Livewire/Schemes/GetConsumerDetails.php:54
        //     "BillMonth" => "JULY",
        //     "dueDate" => "2023-07-31",
        //     "errorCode" => "NA",
        //     "billPeriodStartDt" => "2023-07-01",
        //     "settlementMode" => "Payment pending",
        //     "consNo" => "132010084231",
        //     "netBill" => "2207.0",
        //     "billPeriodEndDt" => "2023-07-31",
        //     "errorMsg" => "NA",
        //     "load" => "9.0",
        //     "unitConsumed" => "53.0",
        //     "contractDemand" => "10.59",
        //     "paidAmount" => "0.0",
        //     "status" => "success",
        // ];

    }

    // public function getSchemeProperty()
    // {
    //     return Scheme::findOrFail($this->schemeId);
    // }

    public function render()
    {
        return view('livewire.schemes.get-consumer-details', [
            'monthOptions' => config('freshman.months'),
            // 'yearOptions' => [
            //     '2020',
            //     '2021',
            //     '2022',
            //     '2023',
            //     '2024'
            // ],
        ]);
    }
}
