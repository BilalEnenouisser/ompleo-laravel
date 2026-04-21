<?php

use App\Http\Resources\GenericApiResource;
use Illuminate\Http\JsonResponse;

if (!function_exists('clean')) {
    function clean($value): string
    {
        return (string) $value;
    }
}

if (!function_exists('api_json')) {
    function api_json($data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        return (new GenericApiResource($data))
            ->response()
            ->setStatusCode($status)
            ->withHeaders($headers);
    }
}
