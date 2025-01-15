<?php

namespace App\Concerns\Traits;

use App\Contracts\RequestContract;
use App\Contracts\ResourceContract;

/**
 * @mixin RequestContract
 */
trait HasResource
{
    public function __construct(
        private ResourceContract $resource,
    ) {
    }

    public function resource(): ResourceContract
    {
        return $this->resource;
    }
}
