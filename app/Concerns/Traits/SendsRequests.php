<?php

namespace App\Concerns\Traits;

use App\Contracts\ClientContract;
use App\Enums\HttpMethod;
use Illuminate\Http\Client\Response;

/**
 * @mixin ClientContract
 */
trait SendsRequests
{
    public function send(HttpMethod $method, string $url, array $options = []): Response
    {
        return $this->request->throw()->send(
            method: $method->value,
            url: $url,
            options: $options,
        );
    }
}
