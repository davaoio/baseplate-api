<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ApiResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        return $response;

        $data = $response->getData();

        if (!property_exists($data, 'http_status')) {
            $data->http_status = $response->status();
        }

        $success = $response->status() < 400;

        if (!property_exists($data, 'success')) {
            $data->success = $success;
        }

        // Add error code when the request has error
        if (!property_exists($data, 'error_code') && !$success) {
            $data->error_code = $this->getStatusKey($response->status());
        }

        $response->setData($data);


    }

    /**
     * Get key that represents an HTTP status code
     *
     * @param Int $code - http status code
     * @return String $key
     */
    private function getStatusKey($code): String
    {
        $reflectionClass = new \ReflectionClass(Response::class);
        return array_search($code, $reflectionClass->getConstants(), true);
    }
}
