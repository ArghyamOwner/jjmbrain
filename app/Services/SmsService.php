<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

// SmsService::make('12345', '12345')
// 	->to(1234567890)
// 	->addVariables([
// 		'name' => 'Hello',
// 		'link' => 'http://google.com'
// 	])
// 	->send()

class SmsService
{
    public $headers = [];
    public $flowId;
    public $senderId = 'INOAPP';
    public $to;
    public $variables = [];

    public function __construct(string $flowId, string $senderId = null)
    {
        $this->flowId = $flowId;
        $this->senderId = $senderId;
    }
   
    public static function make(string $flowId, string $senderId = null)
    {
        return new static($flowId, $senderId);
    }
 
    public function to(string $mobile)
    {
        if (is_null($mobile)) {
            throw new \Exception("Mobile number is required");
        }

        $this->to = '91' . $mobile;

        return $this;
    }

    public function addHeaders(array $headers = [])
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    public function addVariables(array $variables = [])
    {
        $this->variables = $variables;

        return $this;
    }

    private function body()
    {
        return [
            "flow_id" => $this->flowId,
            "sender" => $this->senderId,
            "short_url" => "1",
            "mobiles" => $this->to,
            ...$this->variables
        ];
    }

    public function send()
    {
        return Http::withHeaders([
            'content-type' => 'application/json',
            'authkey' => config('services.msg91.key'),
            ...$this->headers
        ])->post('https://api.msg91.com/api/v5/flow', $this->body());
    }
}