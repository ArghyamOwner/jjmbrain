<?php

namespace App\Http\Controllers\Api\V1\Panchayat;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Panchayat;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'block_id' => ['required'],
        ]);

        $block = Block::select('name')->findOrFail($validate['block_id']);

        $panchayats = Panchayat::query()
            ->when($validate['block_id'], fn($query) => $query->where('block_id', $validate['block_id']))
            ->orderBy('panchayat_name')
            ->get();

        $formattedResponse = '';
        foreach ($panchayats as $panchayat) {
            $formattedResponse .= ($panchayat->id) . '. ' . $panchayat->panchayat_name . "\n";
        }
        $data = ['panchayats' => $formattedResponse, 'block' => $block->name];
        return response()->json($data);
    }
}
