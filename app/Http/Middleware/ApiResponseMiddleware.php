<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $data = $response->getData(true);

            $wrapped = [
                'status' => $response->getStatusCode() < 400 ? 'success' : 'error',
                'message' => $data['message'] ?? ($response->getStatusCode() < 400 ? 'Success' : 'Error'),
                'data' => isset($data['data']) ? $data['data'] : $data
            ];

            $response->setData($wrapped);
        }

        return $response;
    }
}