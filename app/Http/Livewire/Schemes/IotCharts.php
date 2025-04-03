<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Traits\InteractsWithSlideoverModal;
use App\Traits\WithFinancialYear;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class IotCharts extends Component
{
    // use InteractsWithSlideoverModal;
    use WithFinancialYear;
    public $deviceId;
    public $type;
    public $schemeid;
    public $data;

    // public function mount($deviceId, $type, $schemeid)
    // {
    //     $this->deviceId = $deviceId;
    //     $this->type = $type;
    //     $this->schemeid = $schemeid;
    // }

    protected $listeners = [
        'iotChartsSlideover' => 'openModal',
    ];

    // public function openModal($id)
    // {
    //     $this->resetErrorBag();
    //     $this->show = true;
    // }

    public function bulkFlowMeterReading()
    {
        $chartsData = [];
            $response = Http::post('iot.jjmbrain.in/api/getGraphingData', [
                'p1' => 'bulk_flow_meter_reading',
                'deviceId' => $this->deviceId,
            ]);
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        $dataCurrent = $chartsData[0];
        // dd(json_encode($dataCurrent));
        // dd(array_keys($dataCurrent));
        // $dataFaultCode = $chartsData[1];
        return [
            'labels' => array_keys($dataCurrent),
            'lineChartsBulkFlowMeterReading' =>  array_values($dataCurrent),
            // 'lineChartsFaultCode' =>  array_values($dataFaultCode),
        ];
    }
    public function surfacePumps()
    {
        $chartsData = [];
        $parameters = [
            ['p1' => 'surface_pumps', 'p2' => 'status', 'deviceId' => $this->deviceId],
            // ['p1' => 'surface_pumps', 'p2' => 'status', 'deviceId' => $this->deviceId],
        ];
        $responses = Http::pool(function ($pool) use ($parameters) {
            return array_map(function ($param) use ($pool) {
                return $pool->post('iot.jjmbrain.in/api/getGraphingData', $param);
            }, $parameters);
        });
        foreach ($responses as $response) {
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        }
        $dataCurrent = $chartsData[0] ?? [];
        $dataFaultCode = $chartsData[1] ?? [];
        return [
            'labels' => array_keys($dataCurrent),
            'lineSurfacePumps' =>  array_values($dataCurrent),
            // 'lineSurfacePumpsCode' =>  array_values($dataFaultCode),
        ];
    }
    public function getCharts()
    {
        $chartsData = [];
        $itemsP3 = ['phase_voltage_r', 'phase_voltage_y', 'phase_voltage_b'];
        $responses = Http::pool(function ($pool) use ($itemsP3) {
            return array_map(function ($item) use ($pool) {
                return $pool->post('iot.jjmbrain.in/api/getGraphingData', [
                    'p1' => 'electrical_parameters',
                    'p2' => 'realtime_voltage_parameters',
                    'p3' => $item,
                    'deviceId' => $this->deviceId,
                ]);
            }, $itemsP3);
        });
        foreach ($responses as $response) {
            if ($response->successful()) {
                $chartsData[] = data_get($response->json(), 'data');
            } else {
                $chartsData[] = [];
            }
        }
        $dataR = $chartsData[0] ?? [];
        $dataY = $chartsData[1] ?? [];
        $dataB = $chartsData[2] ?? [];
        return [
            'labels' => array_keys($dataR),
            'lineChartsR' =>  array_values($dataR),
            'lineChartsY' =>  array_values($dataY),
            'lineChartsB' =>  array_values($dataB),
        ];
    }

    public function results(): array
    {
        return match ($this->type) {
            'electrical_parameters' => self::getCharts(),
            'surface_pumps' => self::surfacePumps(),
            'bulk_flow_meter_reading' => self::bulkFlowMeterReading(),
            default => [],
        };
    }
    public function typeName(): string
    {
        return match ($this->type) {
            'electrical_parameters' => 'Electrical Parameters',
            'surface_pumps' => 'Surface Pump',
            'bulk_flow_meter_reading' => 'Flow Meter Reading',
            default => '',
        };
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeid);
    }
    public function getChrtsData()
    {
        if ($this->type) {
            $this->data = null;
            $this->data = $this->results();
            $this->emit('refresh-iot-charts', $this->data);
        }
    }

    public function render()
    {
        return view('livewire.schemes.iot-charts');
    }
}
