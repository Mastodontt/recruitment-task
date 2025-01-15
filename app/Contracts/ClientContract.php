<?php

namespace App\Contracts;

use App\Enums\HttpMethod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * @property PendingRequest $request
 */
interface ClientContract
{
    public function send(HttpMethod $method, string $url, array $options = []): Response;
}
