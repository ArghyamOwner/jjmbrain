<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\CasingDiagram;
use App\Models\Division;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Models\WaterLevel;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;

class DivisionWiseLithologReportController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generateLocation(Division $division)
    {
        $lithologLazyCollection = Litholog::query()
            ->with('scheme:id,name,imis_id,division_id')
            ->whereRelation('scheme', 'division_id', $division->id)
            ->orderBy('well_id')
            ->lazy();

        if ($lithologLazyCollection->isNotEmpty()) {
            $lithologs = $lithologLazyCollection->map(fn($data) => [
                'Bore' => $data->well_id,
                'IMIS_ID' => $data->scheme?->imis_id,
                'Scheme' => $data->scheme?->name,
                'Division' => $division->name,
                'Latitude' => $data->latitude,
                'Longitude' => $data->longitude,
                'Elevation' => $data->elevation,
                'Depth' => Lithology::where('litholog_id', $data->id)->max('end'),
                'Discharge (in  L/H)' => $data->discharge,
                'Drawdown (in Meters)' => $data->drawdown,
                'Development Time (in Hrs.)' => $data->duration_pump,
                'Static Water (in Meters)' => $data->static_water,
                'Drilling_Type' => $data->drilling_type,
            ])->toArray();

            return $this->exportToCsv($lithologs, $division->name . '_lithologs.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }

    public function generateLithologies(Division $division)
    {
        $lithologs = Litholog::query()
            ->whereRelation('scheme', 'division_id', $division->id)
            ->pluck('id')->all();

        $lithologies = Lithology::query()
            ->with('litholog:id,well_id', 'pattern:id,category', 'scheme:imis_id')
            ->whereIn('litholog_id', $lithologs)
            ->lazy();

        if ($lithologies->isNotEmpty()) {
            $data = $lithologies->map(fn($data) => [
                'Bore' => $data->litholog?->well_id,
                'IMIS_ID' => $data->scheme?->imis_id,
                'Depth_1' => $data->start,
                'Depth_2' => $data->end,
                'Lithology' => $data->pattern?->category,
            ])->sortBy('Bore')->toArray();

            return $this->exportToCsv($data, $division->name . '_lithologies.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }

    public function generateCasingReports(Division $division)
    {
        $lithologs = Litholog::query()
            ->whereRelation('scheme', 'division_id', $division->id)
            ->pluck('id')->all();

        $casingDiagram = CasingDiagram::query()
            ->with('litholog:id,well_id,casing_size,hole_diameter', 'pattern:id,category', 'scheme:imis_id')
            ->whereIn('litholog_id', $lithologs)
            ->lazy();

        if ($casingDiagram->isNotEmpty()) {
            $data = $casingDiagram->map(fn($data) => [
                'Bore' => $data->litholog?->well_id,
                'IMIS_ID' => $data->scheme?->imis_id,
                'Depth_1' => $data->start,
                'Depth_2' => $data->end,
                'Diameter1' => $data->litholog?->casing_size,
                'Diameter2' => $data->litholog?->hole_diameter,
                'Lithology' => $data->pattern?->category,
            ])->sortBy('Bore')->toArray();

            return $this->exportToCsv($data, $division->name . '_well-constructions.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }

    public function generateAquiferReports(Division $division)
    {
        $lithologs = Litholog::query()
            ->whereRelation('scheme', 'division_id', $division->id)
            ->pluck('id')->all();

        $waterLevel = WaterLevel::query()
            ->with('litholog:id,well_id,latitude,longitude', 'pattern:id,category', 'scheme:imis_id')
            ->whereIn('litholog_id', $lithologs)
            ->whereRelation('pattern', 'category', 'Aquifer')
            ->lazy();

        if ($waterLevel->isNotEmpty()) {
            $data = $waterLevel->map(fn($data) => [
                'Bore' => $data->litholog?->well_id,
                'IMIS_ID' => $data->scheme?->imis_id,
                'Depth_1' => $data->start,
                'Depth_2' => $data->end,
                'Lithology' => $data->pattern?->category,
                'Latitude' => $data->litholog?->latitude,
                'Longitude' => $data->litholog?->longitude,
            ])->sortBy('Bore')->toArray();

            return $this->exportToCsv($data, $division->name . '_aquifer.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }

    public function generateOrientationReports(Division $division)
    {
        $lithologLazyCollection = Litholog::query()
            ->with('scheme:id,imis_id,division_id')
            ->whereRelation('scheme', 'division_id', $division->id)
            ->orderBy('well_id')->lazy();

        if ($lithologLazyCollection->isNotEmpty()) {
            $lithologs = $lithologLazyCollection->map(fn($data) => [
                'Bore' => $data->well_id,
                'IMIS_ID' => $data->scheme?->imis_id,
                'Depth' => 0,
                'Azimuth' => 0,
                'Inclination' => 0,
            ])->toArray();

            return $this->exportToCsv($lithologs, $division->name . '_orientation.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }
}
