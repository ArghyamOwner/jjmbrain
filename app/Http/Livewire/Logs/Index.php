<?php

namespace App\Http\Livewire\Logs;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $apiURL = "https://developers.myoperator.co/search";
        $response = Http::post($apiURL, [
            // "token" => env('MY_OPERATOR_TOKEN'),
            "token" => "12401abc09979b8b7ed88f2409533f1a",
            "filters" => "5,6",
            "page_size" => 100
        ]);
        $statusCode = $response['code'];
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode != '200') {
            $message = "Status Code - $statusCode. " .$responseBody['status']. " - ". $responseBody['message'];
        } else {
            $responseData = $responseBody['data']['hits'];
            $count = $responseBody['data']['total'];
        }

        return view('livewire.logs.index', [
            'message' => $message ?? '',
            'data' => $responseData ?? '',
            'count' => $count ?? 0
        ]);
    }
}
