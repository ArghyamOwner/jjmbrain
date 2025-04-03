<?php

namespace Database\Seeders;

use App\Models\IotDevice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IotDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $iotDevices = [
                [
                    "scheme_id" => '01h2za7d0mb6cc2bz4823dr87f',
                    'mqtt_username' => 'mb6cc2bz4823dr',
                    'mqtt_password' => '2bz4823dr87f',
                    'mqtt_device_id' => '121280821',
                ]
            ];
            foreach ($iotDevices as $iotDevice) {
                IotDevice::create([
                    'scheme_id' => $iotDevice['scheme_id'],
                    'mqtt_username' => $iotDevice['mqtt_username'],
                    'mqtt_password' => $iotDevice['mqtt_password'],
                    'mqtt_device_id' => $iotDevice['mqtt_device_id'],
                ]);
            }
        });
    }
}
