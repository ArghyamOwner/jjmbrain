<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

trait WithLegacyApiFcm
{
	public function notifyFcm(string $to, array $message = null)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'key='.config('jjm.fcm_server_api_key')
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'to' => $to,
            'notification' => $message,
            'data' => $message
        ]);
    }

}

