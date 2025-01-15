<?php

namespace App\Contracts;

/**
 * @property ClientContract $client
 */
interface ResourceContract
{
    public function client(): ClientContract;
}
