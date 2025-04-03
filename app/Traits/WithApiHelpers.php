<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/*
* Response::HTTP_INTERNAL_SERVER_ERROR = 500
* Response::HTTP_TOO_MANY_REQUESTS = 429
* Response::HTTP_UNPROCESSABLE_ENTITY = 422
* Response::HTTP_NOT_FOUND = 404
* Response::HTTP_FORBIDDEN = 403
* Response::HTTP_UNAUTHORIZED = 401
* Response::HTTP_BAD_REQUEST = 400
* Response::HTTP_NO_CONTENT = 204
* Response::HTTP_CREATED = 201
* Response::HTTP_OK = 200
*/

trait WithApiHelpers
{
    protected function respondWithSuccess($data, int $code = Response::HTTP_OK, string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
            'data' => $data,
        ], $code);
    }

    protected function respondWithUnprocessableEntity(string $message = '', array $errors = [])
    {
        $code = Response::HTTP_UNPROCESSABLE_ENTITY;

        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
            'errors' => $errors
        ], $code);
    }

    protected function respondWithError(int $code, string $message = '', array $errors = []): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
            'errors' => $errors
        ], $code);
    }

    protected function respondCreated(string $message = 'Created'): JsonResponse
    {
        $code = Response::HTTP_CREATED;
        
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
        ], $code);
    }

    protected function respondOk(int $code = Response::HTTP_OK, string $message = 'Success'): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
        ], $code);
    }

    protected function respondNotFound(int $code = Response::HTTP_NOT_FOUND, string $message = 'Not found'): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
        ], $code);
    }
    
    protected function respondWithNoContent()
    {
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    protected function respondWithUnauthorized()
    {
        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'message' => 'You are not authorized.'
        ], 422);
    }
    protected function respondWithJsonPaginate(array|object $data = null, int $code = Response::HTTP_OK, string $message = 'success'): JsonResponse
    {
        $dataArray = $data->toArray();
        return response()->json([
            'status' => $code,
            'message' => $message ?? Response::$statusTexts[$code],
            'data' => [
				'data' => $dataArray['data'],
				'links' => [
					'first' => '',
					'last' => '',
					'prev' => $data->previousPageUrl(),
					'next' => $data->nextPageUrl(),
				]
			],
        ], $code);
    }
}
