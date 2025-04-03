<?php

namespace App\Http\Controllers\Api\V1\Block;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\District;
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
            'district_id' => ['required'],
        ]);

        $district = District::select('name')->findOrFail($validate['district_id']);

        $blocks = Block::query()
            ->when($validate['district_id'], fn($query) => $query->where('district_id', $validate['district_id']))
            ->orderBy('name')
            ->get();

        $formattedResponse = '';
        foreach ($blocks as $block) {
            $formattedResponse .= ($block->id) . '. ' . $block->name . "\n";
        }
        $data = ['blocks' => $formattedResponse, 'district' => $district->name];
        return response()->json($data);
    }
}
