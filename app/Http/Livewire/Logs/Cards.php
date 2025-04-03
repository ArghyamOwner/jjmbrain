<?php

namespace App\Http\Livewire\Logs;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Cards extends Component
{
    public function getOutgoingCallCounts()
    {
        $apiURL = "https://developers.myoperator.co/search";
        $response = Http::post($apiURL, [
            "token" => "12401abc09979b8b7ed88f2409533f1a",
            "filters" => "33",
        ]);
        $statusCode = $response['code'];
        $responseBody = json_decode($response->getBody(), true);

        $count = 0;
        if ($statusCode == '200') {
            $count = $responseBody['data']['total'];
        }
        return $count;
    }

    public function getIncomingCallCounts()
    {
        $apiURL = "https://developers.myoperator.co/search";
        $response = Http::post($apiURL, [
            "token" => "12401abc09979b8b7ed88f2409533f1a",
            "filters" => "30",
        ]);
        $statusCode = $response['code'];
        $responseBody = json_decode($response->getBody(), true);

        $count = 0;
        if ($statusCode == '200') {
            $count = $responseBody['data']['total'];
        }
        return $count;
    }

    public function getAllCallCounts()
    {
        $apiURL = "https://developers.myoperator.co/search";
        $response = Http::post($apiURL, [
            "token" => "12401abc09979b8b7ed88f2409533f1a",
            "filters" => "8",
        ]);
        $statusCode = $response['code'];
        $responseBody = json_decode($response->getBody(), true);

        $count = 0;
        if ($statusCode == '200') {
            $count = $responseBody['data']['total'];
        }
        return $count;
    }

    public function getMissedCallCounts()
    {
        $apiURL = "https://developers.myoperator.co/search";
        $response = Http::post($apiURL, [
            "token" => "12401abc09979b8b7ed88f2409533f1a",
            "filters" => "13",
        ]);
        $statusCode = $response['code'];
        $responseBody = json_decode($response->getBody(), true);

        $count = 0;
        if ($statusCode == '200') {
            $count = $responseBody['data']['total'];
        }
        return $count;
    }

    public function render()
    {
        return view('livewire.logs.cards',[
            'outgoingCount' => $this->getOutgoingCallCounts(),
            'incomingCount' => $this->getIncomingCallCounts(),
            'allCount' => $this->getAllCallCounts(),
            'missedCount' => $this->getMissedCallCounts(),
        ]);
    }
}
