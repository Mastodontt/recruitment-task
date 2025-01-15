<?php

namespace App\Services\Pets;

use App\ApiResources\PetsResource;
use App\Concerns\Traits\SendsRequests;
use App\Contracts\ClientContract;
use Illuminate\Http\Client\PendingRequest;

final class PetClient implements ClientContract
{
    use SendsRequests;

    public function __construct(
        private readonly PendingRequest $request,
    ) {
    }

    public function pets(): PetsResource
    {
        return new PetsResource(
            client: $this,
        );
    }
}
