<?php

namespace App\DataTransferObjects;

final readonly class Pet
{
    public function __construct(
        public int $id,
        public string $name,
        public ?array $category,
        public array $photoUrls,
        public array $tags,
        public string $status
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['category'],
            $data['photoUrls'],
            $data['tags'],
            $data['status']
        );
    }
}
