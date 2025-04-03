<?php

namespace App\Services;

class TextLocalService
{

	public static function send()
	{
		// Account details
		$apiKey = urlencode('NDc2MjY3NDg3MTUzMzc0NjRkNDE0MzY1NTIzNDY5Njc=');
		
		// Message details
		$numbers = urlencode('917086051060');
		$sender = urlencode('TXTLCL');
		$message = rawurlencode('Dear Bidder you have successfully purchased bid document for tender number TD123. From DH Tender');
	
		// Prepare data for POST request
		$data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
	
		// Send the GET request with cURL
		$ch = curl_init('https://api.textlocal.in/send/?' . $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		// Process your response here
		echo $response;
	}
}