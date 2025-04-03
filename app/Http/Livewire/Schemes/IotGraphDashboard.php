<?php

namespace App\Http\Livewire\Schemes;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class IotGraphDashboard extends Component
{
    public $deviceId;
    public $schemeId;
    public $data;
    public $dataLinechart;
    public $loading = false;
    public $type;
    public $totalCount = 0;
    public $totalPower;
    public $totalFlow;

    public function mount($deviceId, $schemeId)
    {
        $this->deviceId = $deviceId;
        $this->schemeId = $schemeId;
    }

    public function getCharts($type)
    {
        $chartsData = [];
        $response = Http::post('iot.jjmbrain.in/api/analytics', [
            'days' => $this->chartManyDays($type),
            'deviceId' => $this->deviceId,
        ]);
        if ($response->successful()) {
            $chartsData = data_get($response->json(), 'analytics', []);
        } else {
            $chartsData = [];
        }
        return $chartsData;
    }

    public function getLineChrtsData($type)
    {
            $chartsData = [];
            $name = 'Submersible Pump';
            $body = [
                'p1' => 'submersible_pump',
                'p2' => 'status',
                'deviceId' => $this->deviceId,
                'days' =>1,
            ];
            if($type == 'valve_operation'){
                $body = [
                    'p1' => 'delivery_valve',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ];
                $name = 'Valve Operation';
            }
            if($type == 'ground_water_level'){
                $body = [
                    'p1' => 'ground_water_level',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ];
                $name = 'Ground Water Level';
            }
            if($type == 'flowmeter'){
                $body = [
                    'p1' => 'bulk_flow_meter_reading',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ];
                $name = 'Flow Meter';
            }
            if($type == 'power_factor'){
                $body = [
                    'p1' => 'electrical_parameters',
                    'p2' => 'pf',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ];
                $name = 'Power Factor';
            }
            if($type == 'chlorineanalyzer'){
                $body = [
                    'p1' => 'chlorine',
                    'p2' => 'residual_chlorine',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ];
                $name = 'Chlorine Analyzer';
            }
            if($type == 'level_indications'){
                return $this->getLineChrtsMultipleData($name);
            }
            if($type == 'surface_submersible'){
                return $this->getLineChrtsSurfaceSubmersibleData($name);
            }
            if($type == '3phase_lectrical_arameters'){
                return $this->getLineChrts3phase_lectrical_arametersData($name);
            }
            if($type == 'remoteAnalytics'){
            //     $response = Http::post('iot.jjmbrain.in/api/remoteAnalytics', 
            //     [ 
            //         'deviceId' => $this->deviceId,
            //         'days' => 8,
            //     ]);
            //     if ($response->successful()) {
            //         // dd($response->json());
            //         $chartsData[] = data_get($response->json(), 'remoteAnalytics');
            //     } else {
            //         $chartsData[] = [];
            //     }
            // $dataCurrent = $chartsData[0];
            // $this->dataLinechart =null;
            // $this->data = [
            //     'labels' => array_keys($dataCurrent),
            //     'remoteFlowMeter' =>  array_values($dataCurrent),
            // ];
            // $this->emit('refresh-iot-graph-dashboard', $this->data, 'Remote FlowMeter');
            $chartsData = [];
            $response = Http::post('iot.jjmbrain.in/api/remoteAnalytics', 
            [ 
                'deviceId' => $this->deviceId,
                'days' => 8,
            ]);
            if ($response->successful()) {
                $chartsData = data_get($response->json(), 'remoteAnalytics', []);
            } else {
                $chartsData = [];
            }
            $this->dataLinechart =null;
            $this->data = $chartsData;
            // dd($this->data);
            $this->emit('refresh-iot-graph-dashboard', $this->data, $type);
            return;
            }
            $response = Http::post('iot.jjmbrain.in/api/getGraphingData', $body );
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        $dataCurrent = $chartsData[0];
        $this->data =null;
        $this->dataLinechart = [
            'labels' => array_keys($dataCurrent),
            'submersible_pump' =>  array_values($dataCurrent),
        ];
        $this->emit('refresh-iot-graph', $this->dataLinechart, $name);
    }
    public function getLineChrts3phase_lectrical_arametersData($name)
    {
        $chartsData = [];
        $items = ['phase_voltage_r', 'phase_voltage_y', 'phase_voltage_b'];
        $responses = Http::pool(function ($pool) use ($items) {
            return array_map(function ($item) use ($pool) {
                return $pool->post('iot.jjmbrain.in/api/getGraphingData', [
                    'p1' => 'electrical_parameters',
                    'p2' => 'realtime_voltage_parameters',
                    'p3' => $item,
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ]);
            }, $items);
        });
        foreach ($responses as $response) {
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        }
        $this->data =null;
        $data1 = $chartsData[0] ?? [];
        $data2 = $chartsData[1] ?? [];
        $data3 = $chartsData[2] ?? [];
        $this->dataLinechart = [
            'labels' => array_keys($data1),
            'phase_electrical_arameters' =>  array_values($data1),
            'phase_electrical_arameters1' =>  array_values($data2),
            'phase_electrical_arameters2' =>  array_values($data3),
        ];
        $this->emit('refresh-iot-graph', $this->dataLinechart, $name);
    }
    public function getLineChrtsSurfaceSubmersibleData($name)
    {
        $chartsData = [];
        $items = ['surface_pumps', 'submersible_pump'];
        $responses = Http::pool(function ($pool) use ($items) {
            return array_map(function ($item) use ($pool) {
                return $pool->post('iot.jjmbrain.in/api/getGraphingData', [
                    'p1' => $item,
                    'p2' => 'status',
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ]);
            }, $items);
        });
        foreach ($responses as $response) {
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        }
        $this->data =null;
        $data1 = $chartsData[0] ?? [];
        $data2 = $chartsData[1] ?? [];
        $this->dataLinechart = [
            'labels' => array_keys($data1),
            'level_indications1' =>  array_values($data1),
            'level_indications2' =>  array_values($data2),
        ];
        $this->emit('refresh-iot-graph', $this->dataLinechart, $name);
    }
    public function getLineChrtsMultipleData($name)
    {
        $chartsData = [];
        $items = ['ugr', 'esr'];
        $responses = Http::pool(function ($pool) use ($items) {
            return array_map(function ($item) use ($pool) {
                return $pool->post('iot.jjmbrain.in/api/getGraphingData', [
                    'p1' => 'water_levels',
                    'p2' => $item,
                    'deviceId' => $this->deviceId,
                    'days' =>1,
                ]);
            }, $items);
        });
        foreach ($responses as $response) {
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        }
        $this->data =null;
        $data1 = $chartsData[0] ?? [];
        $data2 = $chartsData[1] ?? [];
        $this->dataLinechart = [
            'labels' => array_keys($data1),
            'level_indications1' =>  array_values($data1),
            'level_indications2' =>  array_values($data2),
        ];
        $this->emit('refresh-iot-graph', $this->dataLinechart, $name);
    }
    
    

    public function results($type): array
    {
        return match ($type) {
            'pumps' => self::getCharts($type),
            default => self::getCharts($type),
        };
    }

    public function chartManyDays($type): int
    {
        return match ($type) {
            'power' => 1,
            'flow' => 1,
            default => 7,
        };
    }

    public function getChrtsData($type)
    {
        if ($type) {
            $this->loading = true;
            $this->type = $type;
            $this->data = $this->results($type);
            if($this->type == 'power' || $this->type == 'flow' && isEmpty($this->data)){
                $this->totalCount = $this->data[0]['analytics'][$type];
            }
            $this->loading = false;
            $this->dataLinechart =null;
            $this->emit('refresh-iot-graph-dashboard', $this->data, $type);
        }
    }

    public function initCall($type){
        $data = $this->getCharts($type);
        if(count($data) != 0){
            $this->totalPower = $data[0]['analytics']['powerdiff'];
            $this->totalFlow = $data[0]['analytics']['flow'];
        }else{ 
            $this->totalPower = 0;
            $this->totalFlow = 0;
        }
    }

    public function render()
    {
        return view('livewire.schemes.iot-graph-dashboard');
    }
}
