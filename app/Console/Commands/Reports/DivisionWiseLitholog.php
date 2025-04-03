<?php

namespace App\Console\Commands\Reports;

use App\Models\CasingDiagram;
use App\Models\Division;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Models\Report;
use App\Models\WaterLevel;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DivisionWiseLitholog extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-litholog';

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
        $divisions = Division::select('name', 'id')->orderBy('name', 'asc')->get();
        foreach ($divisions as $division) {
            $this->line($division->name);

            // Locations
            $lithologLazyCollection = Litholog::query()
                ->with('scheme:id,name,imis_id,division_id', 'checkedBy:id,name', 'verifiedBy:id,name')
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
                    'Checked By' => $data->checkedBy?->name,
                    'Verified By' => $data->verifiedBy?->name,
                    'Created_At' => $data->created_at?->format('d/m/Y')
                ])->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($lithologs, $fileName . '_lithologs.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVLITHO',
                    'title' => 'Locations',
                    'category' => Report::CATEGORY_LITHOLOG_LOCATION_REPORT,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }

            $lithologsIds = $lithologLazyCollection->pluck('id')->all();

            // Lithologies
            $lithologies = Lithology::query()
                ->with('litholog:id,well_id', 'pattern:id,category', 'scheme:imis_id')
                ->whereIn('litholog_id', $lithologsIds)
                ->lazy();
            if ($lithologies->isNotEmpty()) {
                $data = $lithologies->map(fn($data) => [
                    'Bore' => $data->litholog?->well_id,
                    'Division' => $division->name,
                    'IMIS_ID' => $data->scheme?->imis_id,
                    'Depth_1' => $data->start,
                    'Depth_2' => $data->end,
                    'Lithology' => $data->pattern?->category,
                ])->sortBy('Bore')->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_lithologies.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVLITHO',
                    'title' => 'Lithologies',
                    'category' => Report::CATEGORY_LITHOLOG_LITHOLOGY_REPORT,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }

            // Well Construction
            $casingDiagram = CasingDiagram::query()
                ->with('litholog:id,well_id,casing_size,hole_diameter,latitude,longitude', 'pattern:id,category', 'scheme:imis_id')
                ->whereIn('litholog_id', $lithologsIds)
                ->lazy();
            if ($casingDiagram->isNotEmpty()) {
                $data = $casingDiagram->map(fn($data) => [
                    'Bore' => $data->litholog?->well_id,
                    'Division' => $division->name,
                    'IMIS_ID' => $data->scheme?->imis_id,
                    'Depth_1' => $data->start,
                    'Depth_2' => $data->end,
                    'Diameter1' => $data->litholog?->casing_size,
                    'Diameter2' => $data->litholog?->hole_diameter,
                    'Lithology' => $data->pattern?->category,
                    'Latitude' => $data->litholog?->latitude,
                    'Longitude' => $data->litholog?->longitude,
                ])->sortBy('Bore')->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_well-constructions.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVLITHO',
                    'title' => 'Well-Constructions',
                    'category' => Report::CATEGORY_LITHOLOG_WELL_CONSTRUCTION_REPORT,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }

            // Aquifer
            $waterLevel = WaterLevel::query()
                ->with('litholog:id,well_id,latitude,longitude', 'pattern:id,category', 'scheme:imis_id')
                ->whereIn('litholog_id', $lithologsIds)
                ->whereRelation('pattern', 'category', 'Aquifer')
                ->lazy();
            if ($waterLevel->isNotEmpty()) {
                $data = $waterLevel->map(fn($data) => [
                    'Bore' => $data->litholog?->well_id,
                    'Division' => $division->name,
                    'IMIS_ID' => $data->scheme?->imis_id,
                    'Depth_1' => $data->start,
                    'Depth_2' => $data->end,
                    'Lithology' => $data->pattern?->category,
                    'Latitude' => $data->litholog?->latitude,
                    'Longitude' => $data->litholog?->longitude,
                ])->sortBy('Bore')->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_aquifer.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVLITHO',
                    'title' => 'Aquifer',
                    'category' => Report::CATEGORY_LITHOLOG_AQUIFER_REPORT,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }

            // Orientation
            $lithologLazyCollection = Litholog::query()
                ->with('scheme:id,imis_id,division_id')
                ->whereRelation('scheme', 'division_id', $division->id)
                ->orderBy('well_id')->lazy();
            if ($lithologLazyCollection->isNotEmpty()) {
                $data = $lithologLazyCollection->map(fn($data) => [
                    'Bore' => $data->well_id,
                    'Division' => $division->name,
                    'IMIS_ID' => $data->scheme?->imis_id,
                    'Depth' => 0,
                    'Azimuth' => 0,
                    'Inclination' => 0,
                ])->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_orientation.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVLITHO',
                    'title' => 'Orientations',
                    'category' => Report::CATEGORY_LITHOLOG_ORIENTATION_REPORT,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }
        }
    }
}
