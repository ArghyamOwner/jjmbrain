<?php

namespace App\Http\Controllers\Reports;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WithExportToCsv;

class TrainerListReportController extends Controller
{
    use WithExportToCsv;

    public function __invoke(Request $request)
    {
        $trainers = Trainer::query()
            ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                $query->where('district_id', auth()->user()->districts->first()['id']);
            })
            ->withCount("jalshalaTrainerOnes", "jalshalaTrainerTwos")
            ->with(["district", "educationBlock"])
            ->lazy()
            ->sortBy("district.name");

        $data = $trainers
            ->map(
                fn ($data) => [
                    "district" => $data->district?->name,
                    "education_block" => $data->educationBlock?->block_name,
                    "trainer_type" => $data->trainer_type,
                    "trainer_name" => $data->trainer_name,
                    "trainer_phone" => $data->phone_number,
                    "organisation" => $data->organisation?->name,
                    "bank_name" => $data->bank_name,
                    "account_number" => $data->account_number,
                    "ifsc_code" => $data->ifsc_code,
                    "no_of_jalshalas" => $data->jalshala_trainer_ones_count + $data->jalshala_trainer_twos_count
                ]
            )
            ->toArray();

        return $this->exportToCsv($data, 'trainer_list.csv');
    }
}
