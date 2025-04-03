<?php

namespace App\Http\Controllers\Api\V1\Sarathi;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Scheme;
use Illuminate\Support\Facades\Date;

class IndexController extends Controller
{
    use WithApiHelpers;
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:blocks,id',
        ]);
        $blockId = $validated['block_id'];
        $days = 7;
        $startDate = Date::now()->subDays($days)->startOfDay();
        $endDate = Date::now();
        $block = Block::with(['district'])->where('id', $blockId)->first();
        $info = [
            'start_date' => $startDate,
            'end_date' =>  $endDate,
            'district' => $block->district->name,
            'block' => $block->name,
        ];
        $schemes = Scheme::with(['user', 'users', 'flowmeterDetails' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }])->where('district_id', $block->district_id)->get();

        $details = $schemes->map(function ($scheme) use ($startDate, $days) { 
            $readings = collect(range(0, $days - 1))->mapWithKeys(function ($day) use ($startDate) {
                $date = $startDate->copy()->addDays($day)->format('d/m/Y');
                return [$date => "0"];
            });
            $scheme->flowmeterDetails?->each(function ($reading) use (&$readings, $startDate, $days) {
                $date = $reading->created_at->startOfDay()->format('d/m/Y');
                if ($readings->has($date)) {
                    $readings[$date] = $reading->value;
                }
            });
            $so_details = $scheme->users?->map(function ($so) {
                return [
                    'so_name' => $so->name,
                    'so_phone' => $so->phone,
                ];
            });
            return [
                'name' =>  $scheme->name,
                'id' => $scheme->imis_id,
                'jm_name' =>  $scheme->user?->name,
                'jm_phone' => $scheme->user?->phone,
                'reading' =>  $readings,
                'so_details' => $so_details,
            ];
        });
        $data = [
            'info' => $info,
            'details' => $details,
        ];
        return $this->respondWithSuccess($data);
    }
}
