<?php

namespace App\ApiResources;

use App\Concerns\Traits\CanAccessClient;
use App\Contracts\ResourceContract;
use App\Enums\HttpMethod;
use Illuminate\Http\Client\Response;

final class PetsResource implements ResourceContract
{
    use CanAccessClient;

    public function getById(int $id): Response
    {
        return $this->client()
            ->send(HttpMethod::Get, 'pet/'.$id);
    }

    public function create(array $data): Response
    {
        return $this->client()
            ->send(HttpMethod::Post, 'pet', [
                'json' => $data,
            ]);
    }

    public function update(array $data): Response
    {
        return $this->client()
            ->send(HttpMethod::Put, 'pet', [
                'json' => $data,
            ]);
    }

    public function delete(int $id): Response
    {
        return $this->client()
            ->send(HttpMethod::Delete, 'pet/'.$id);
    }
}
