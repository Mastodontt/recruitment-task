<?php

namespace App\Http\Requests\Pets;

final class PetUpdateRequest extends PetBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return parent::rules();
    }
}
