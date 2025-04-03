<?php

namespace App\Http\Livewire\Schemes;

use App\Models\DeviceCommand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class IOT extends Component
{
    public const RUNNING_DURATION = 18; // 6 is equal to 1 min
    public $loading = false;
    public $count = 0;
    public $message = '';
    public $deviceid;
    public $schemeid;
    public $search;
    public $command;
    public $commandtype;
    public $description;
    public $isExpired;
    public $isShowGraph = false;
    public $iotData = [];
    public $selectedType;

    // public function iotKey() {
    //     return  str()->random();
    // }

    public function updateExpirationStatus()
    {
        $this->isExpired = self::RUNNING_DURATION <= $this->count;
    }

    public function mount($deviceid, $schemeid)
    {
        $this->deviceid = $deviceid;
        $this->schemeid = $schemeid;
        $user = auth()->user();
        $allowUsers = ['sumatoglobal@gmail.com', 'hydrovervetechnologies1@gmail.com'];
        $this->isShowGraph = in_array($user->email, $allowUsers);
    }

    public function sendCommand($sendCommand)
    {
        try {
            sleep(10);
            $body = [
                'topic' => 'dev-' . $this->deviceid,
                'message' => $sendCommand
            ];
            $response = Http::post('http://iot.jjmbrain.in/api/sendCommand', $body);
            if ($response->ok()) {
                $data = $response->json();
                if ($data['status'] === 'success') {
                    $this->notify('Device Command Sent.');
                } else {
                    $this->notify('Failed To Send Command.');
                }
            }
            $this->dispatchBrowserEvent('hide-modal');
            $this->emit('$refreshData');
        } catch (\Exception $e) {
            $this->notify('Failed To Send Command.');
            Log::info($e->getMessage());
        }
    }
    public function restartapi()
    {
        $this->count = 0;
        self::updateExpirationStatus();
        $this->getIot();
    }

    public function save()
    {
        $validated = $this->validate([
            'command' => ['required'],
            'commandtype' => ['required'],
            'description' => ['required'],
        ]);
        DeviceCommand::create([
            'user_id' => auth()->user()->id,
            'scheme_id' => $this->schemeid,
            'command' => $validated['command'],
            'type' => $validated['commandtype'],
            'description' => $validated['description'],
        ]);
        $this->reset(['command', 'commandtype', 'description']);
        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('Command added Successfully.');
    }

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function reFetch()
    {
        $this->loading = !$this->loading;
    }

    public function sendCommandManual($type)
    {
        try {
            $this->getIot();
            sleep(10);
            $body = [
                'topic' => 'dev-' . $this->deviceid,
                'message' => [
                    'valve' => $type == 'valve' ? ($this->iotData['i'] == 1 ? 0 : 1) : $this->iotData['i'],
                    'motor' => $type == 'motor' ? ($this->iotData['ad'] == 1 ? 0 : 1) : $this->iotData['ad'],
                    'motor1' => $type == 'motor1' ? ($this->iotData['z'] == 1 ? 0 : 1) : $this->iotData['z'],
                    'timestamp' => Carbon::now()->timestamp,
                ]
            ];
            $response = Http::post('http://iot.jjmbrain.in/api/sendCommand', $body);
            if ($response->ok()) {
                $data = $response->json();
                if ($data['status'] === 'success') {
                    $this->notify('Device Command Sent.');
                } else {
                    $this->notify('Failed To Send Command.');
                }
            }
            $this->dispatchBrowserEvent('hide-modal');
            $this->emit('refreshData');
        } catch (\Exception $e) {
            $this->notify('Failed To Send Command.');
            Log::info($e->getMessage());
        }
    }

    public function getIot()
    {
        if ($this->isExpired) {
            return;
        }
        $this->count++;
        self::updateExpirationStatus();
        $response = Http::timeout(60)->post('iot.jjmbrain.in/api/getStatus', [
            'deviceId' => $this->deviceid,
        ]);
        $this->iotData = [
            'isLessThan' => false,
            'a' => '',
            'b' => '',
            'c' => '',
            'd' => '',
            'e' => 0,
            'f' => '',
            'g' => '',
            'h' => '',
            'i' => '',
            'j' => '',
            'k' => '',
            'l' => '',
            'm' => '',
            'n' => 0,
            'o' => '',
            'p' => '',
            'q' => '',
            'r' => '',
            's' => '',
            't' => '',
            'u' => '',
            'v' => '',
            'w' => 0,
            'x' => 0,
            'y' => '',
            'z' => '',
            'aa' => '',
            'ab' => '',
            'ac' => '',
            'ad' => '',
            'ae' => '',
            'af' => '',
            'ag' => '',
            'ah' => '',
            'ai' => '',
            'aj' => '',
            'ak' => '',
        ];
        if ($response->successful()) {
            $timestampDate = Carbon::createFromTimestamp(data_get($response, 'log.timestamp'));
            $now = Carbon::now();
            // dd(json_encode($response->json()));
            // dd($now->timestamp.'-ok-'.$timestampDate->timestamp.'-ok-'.$now->diffInSeconds($timestampDate));
            $isLessThan = $now->diffInSeconds($timestampDate) < 60;
            $this->iotData = [
                'a' => data_get($response, 'log.device_id'),
                'b' => data_get($response, 'log.timestamp'),
                'isLessThan' => $isLessThan,
                'c' => data_get($response, 'log.operating_mode'),
                'd' => data_get($response, 'log.payload.battery_time_remaining'),
                'e' => data_get($response, 'log.payload.battery_level') ?? 0,
                'f' => data_get($response, 'log.payload.grid_status'),
                'g' => data_get($response, 'log.payload.bulk_flow_meter_reading'),
                'h' => data_get($response, 'log.payload.bulk_flow_meter_rate'),
                'i' => data_get($response, 'log.payload.delivery_valve'),
                'j' => data_get($response, 'log.payload.domestic_meter_mech'),
                'k' => data_get($response, 'log.payload.domestic_meter_em'),
                'l' => data_get($response, 'log.payload.surface_pump_switchover'),
                'm' => data_get($response, 'log.payload.backwash_indication'),
                'n' => data_get($response, 'log.payload.ground_water_level'),
                'o' => data_get($response, 'log.payload.electrical_parameters.pf'),
                'p' => data_get($response, 'log.payload.electrical_parameters.total_KW'),
                'q' => data_get($response, 'log.payload.electrical_parameters.total_KWH'),
                'r' => data_get($response, 'log.payload.electrical_parameters.realtime_current'),
                's' => data_get($response, 'log.payload.electrical_parameters.realtime_voltage_parameters.phase_voltage_r'),
                't' => data_get($response, 'log.payload.electrical_parameters.realtime_voltage_parameters.phase_voltage_y'),
                'u' => data_get($response, 'log.payload.electrical_parameters.realtime_voltage_parameters.phase_voltage_b'),
                'v' => data_get($response, 'log.payload.electrical_parameters.realtime_voltage_parameters.3_phase_voltage_avg'),
                'w' => data_get($response, 'log.payload.water_levels.esr') ?? 0,
                'x' => data_get($response, 'log.payload.water_levels.ugr') ?? 0,
                'y' => data_get($response, 'log.payload.water_levels.tp'),
                'z' => data_get($response, 'log.payload.submersible_pump.status'),
                'aa' => data_get($response, 'log.payload.submersible_pump.current'),
                'ab' => data_get($response, 'log.payload.submersible_pump.fault.fault_exist'),
                'ac' => data_get($response, 'log.payload.submersible_pump.fault.fault_code'),
                'ad' => data_get($response, 'log.payload.surface_pumps.status'),
                'ae' => data_get($response, 'log.payload.surface_pumps.current'),
                'af' => data_get($response, 'log.payload.surface_pumps.fault.fault_exist'),
                'ag' => data_get($response, 'log.payload.surface_pumps.fault.fault_code'),
                'ah' => data_get($response, 'log.payload.chlorine.residual_chlorine'),
                'ai' => data_get($response, 'log.payload.chlorine.ph'),
                'aj' => data_get($response, 'log.payload.chlorine.chlorine_doser_pump_status'),
                'ak' => data_get($response, 'log.payload.chlorine.chlorine_tank_level'),
            ];
        } 
    }

    public function viewSelectedType($type)
    {
        $this->selectedType = $type;
    }

    public function render()
    {
        if ($this->isExpired) {
            $this->dispatchBrowserEvent('show-dialog');
            return view('livewire.schemes.i-o-t', [
                'response' => $this->iotData,
                ...$this->iotData,
                'commands' => DeviceCommand::where('scheme_id', $this->schemeid)
                    ->latest('id')
                    ->fastPaginate(10),
            ]);
        }
        $this->getIot();
        return view('livewire.schemes.i-o-t', [
            'response' => $this->iotData,
            ...$this->iotData,
            'commands' => DeviceCommand::where('scheme_id', $this->schemeid)
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
