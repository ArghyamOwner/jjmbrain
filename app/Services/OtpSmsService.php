<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

// OtpSmsService::make('12345')
// 	->to(1234567890)
// 	->sendSms() // ->resendSms() // ->verifySms()

class OtpSmsService
{
    public $headers = [];
    public $templateId;
    public $to;
    public $otp;
    public $variables = [];

    public function __construct(string $templateId = null)
    {
        $this->templateId = $templateId;
    }
   
    public static function make(string $templateId = null)
    {
		if ($templateId) {
			return new static($templateId);
		}

		return new static;
    }
 
    public function to(string $mobile)
    {
        if (is_null($mobile)) {
            throw new \Exception("Mobile number is required");
        }

        $this->to = '91' . $mobile;

        return $this;
    }

	public function otp(string $otp)
    {
        if (is_null($otp)) {
            throw new \Exception("OTP is required");
        }

        $this->otp = $otp;

        return $this;
    }

    public function addHeaders(array $headers = [])
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    public function sendOtp()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'authkey' => config('services.msg91.otp_key'),
            ...$this->headers
        ])->post("https://control.msg91.com/api/v5/otp?mobile={$this->to}&template_id={$this->templateId}&otp_length=6&otp_expiry=1");

        $response->throw();

        return $response;
    }

	public function verifyOtp()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'authkey' => config('services.msg91.otp_key'),
            ...$this->headers
        ])->get("https://control.msg91.com/api/v5/otp/verify", [
            'mobile' => $this->to,
            'otp' => $this->otp,
        ]);

        $response->throw();

        return $response->json();
    }

	public function resendOtp()
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'authkey' => config('services.msg91.otp_key'),
            ...$this->headers
        ])->get("https://control.msg91.com/api/v5/otp/retry", [
            'retrytype' => 'text',
            'mobile' => $this->to
        ]);

        $response->throw();

        return $response->json();
    }
}