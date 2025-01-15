<?php

namespace App\Concerns\Traits;

use App\Contracts\ClientContract;
use App\Contracts\ResourceContract;

/**
 * @mixin ResourceContract
 */
trait CanAccessClient
{
    public function __construct(
        private readonly ClientContract $client,
    ) {
    }

    public function client(): ClientContract
    {
        return $this->client;
    }
}
