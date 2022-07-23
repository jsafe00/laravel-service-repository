<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


trait HasApiResponse
{
    protected function ApiErrorResponse($errors = null, $massage = null, $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = $this->errorResponse($code, $errors, $massage);

        return response()->json($response);
    }

    /**
     * Returns general error
     *
     * @param null $data
     * @param null $massage
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function ApiSuccessResponse($data = null, $massage = null): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, $massage);

        return response()->json($response);
    }

    /**
     * Return error when request is properly formatted, but contains validation errors
     *
     * @param $errors_array
     *
     * @return JsonResponse
     * @author <ferasbbm>
     */
    protected function validationErrorResponse($errors_array): JsonResponse
    {
        $errors = [];

        foreach ($errors_array as $key => $value) {
            $errors[] = [
                'field' => $key,
                'error' => $value[ 0 ],
            ];
        }

        $response = $this->errorResponse(Response::HTTP_UNPROCESSABLE_ENTITY, compact('errors'),
            trans('api.UnprocessableEntity'));

        return response()->json($response);
    }

    /**
     * Standard error envelope structure
     *
     * @param int    $code
     * @param mixed  $errors
     * @param string $message
     *
     * @return array
     * @author <ferasbbm>
     */
    private function errorResponse(int $code = Response::HTTP_BAD_REQUEST, $errors = [],
        string $message = 'Bad Request'): array
    {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
        ];

        is_array($errors)
            ? $response = array_merge($response, $errors)
            : $response[ 'errors' ] = $errors;

        return $response;
    }

    /**
     * Standard success envelope structure
     *
     * @param int    $code
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     * @author <ferasbbm>
     */
    private function successResponse(int $code = Response::HTTP_OK, $data = [], string $message = 'OK'): array
    {
        $response = [
            'status' => true,
            'code' => $code,
            'message' => $message,
        ];

        is_array($data)
            ? $response = array_merge($response, $data)
            : $response[ 'data' ] = $data;

        return $response;
    }
}

