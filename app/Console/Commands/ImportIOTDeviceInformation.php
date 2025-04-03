<?php

namespace App\Console\Commands;

use App\Models\IotDevice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Str;

class ImportIOTDeviceInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-i-o-t-device-information';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $devices = json_decode(file_get_contents(base_path('database/scheme_iot_devices.json')));
        $progressBar = $this->output->createProgressBar(count($devices));
        $this->line('scheme_iot_devices importing...');
        $progressBar->start(); 
            DB::beginTransaction();
            try {
                foreach ($devices as $record) {
                    IotDevice::create([
                            'scheme_id' => $record->scheme_id,
                            'mqtt_username' => $record->mqtt_username,
                            'mqtt_password' =>$record->mqtt_password,
                            'mqtt_device_id' => $record->mqtt_device_id,
                    ]);
                    $this->line('');
                    // $this->info($record['scheme_id']);
                    $this->info('Imported Successfully!');
                    }
                DB::commit();
            }catch (\Exception $e) {
                DB::rollBack(); 
                $this->info('Imported Faild! ->'. $e->getMessage());
                return response()->json([
                    'message' => 'Failed to import devices',
                    'status' => 500,
                ]);
        }
        
    }
}
