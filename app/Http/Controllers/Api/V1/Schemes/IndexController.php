<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeResource;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $divisions = auth()->user()->divisions;

        $schemes = Scheme::query()
            ->with(['division.circle', 'district', 'blocks', 'financialYear'])
            ->when($request->s, fn($query) => $query->whereLike('name', $request->s))
        // ->whereIn('division_id', $divisions->pluck('id')->all())
        // ->when(!auth()->user()->isSectionOfficer(), fn($query) =>
        //     $query->whereIn('division_id', $divisions->pluck('id')->all())
        // )
            ->when(auth()->user()->isSectionOfficer(), function ($query) {
                $query->whereHas('users', function ($subQuery) {
                    $subQuery->where('users.id', Auth::id());
                });
            }, function ($query) {
                $query->whereIn('division_id', auth()->user()->divisions->pluck('id')->all());
            })
            ->simplePaginate();

        return $this->respondWithSuccess(
            SchemeResource::collection($schemes)->response()->getData(true),
            Response::HTTP_OK,
            'Scheme lists'
        );
    }
}
