<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ContractorHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bid_no' => $this->contractor?->bid_no,
            'workorders_count' => $this->workorders_count,
            'schemes' => DB::table('users')
                ->join('workorders', 'users.id', '=', 'workorders.contractor_id')
                ->join('scheme_workorder', 'workorders.id', '=', 'scheme_workorder.workorder_id')
                ->join('schemes', 'scheme_workorder.scheme_id', '=', 'schemes.id')
                ->where('users.id', auth()->id())
                ->distinct()
                ->count('schemes.id'),
            'handed_schemes' => DB::table('users')
                ->join('workorders', 'users.id', '=', 'workorders.contractor_id')
                ->join('scheme_workorder', 'workorders.id', '=', 'scheme_workorder.workorder_id')
                ->join('schemes', 'scheme_workorder.scheme_id', '=', 'schemes.id')
                ->where('schemes.work_status', 'handed-over')
                ->where('users.id', auth()->id())
                ->distinct()
                ->count('schemes.id'),
        ];
    }
}
