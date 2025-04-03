<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use Symfony\Component\HttpFoundation\Response;

class ClassSubjectVideosController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($class, $subject)
    {
        $videos = Video::query()
            ->withWhereHas('subject.class', function ($query) use ($class) {
                $query->where('id', $class);
            })
            ->where('subject_id', $subject)
            ->get();
 
        if (! $videos) {
            return $this->respondNotFound();
        }

        return $this->respondWithSuccess(
            VideoResource::collection($videos),
            Response::HTTP_OK,
            "Video List"
        );
    }
}
