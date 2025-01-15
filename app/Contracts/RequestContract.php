<?php

namespace App\Contracts;

/**
 * @property ResourceContract $resource
 */
interface RequestContract
{
    public function resource(): ResourceContract;
}
