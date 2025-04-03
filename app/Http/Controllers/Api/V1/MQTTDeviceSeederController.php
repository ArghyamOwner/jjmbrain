<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\IotDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MQTTDeviceSeederController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $deviceDetails = $request->json();
            DB::beginTransaction();
            try {
                foreach ($deviceDetails as $data) {
                    IotDevice::create([
                        'scheme_id' => $data['scheme_id'],
                        'mqtt_username' => $data['mqtt_username'],
                        'mqtt_password' => $data['mqtt_password'],
                        'mqtt_device_id' => $data['mqtt_device_id'],
                    ]);
                }
                DB::commit();
            }catch (\Exception $e) {
                DB::rollBack(); 
                return response()->json([
                    'message' => 'Failed to import devices',
                    'status' => 500,
                ]);
            }
        return response()->json([
            'message' => 'Devices successfully imported',
            'status' => 200,
        ]);
    }
}
