<?php

namespace App\Http\Requests\Pets;

use App\Enums\PetStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetBaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'category.id' => 'nullable|integer',
            'category.name' => 'nullable|string|max:255',
            'photoUrls' => 'nullable|array|min:1',
            'photoUrls.*' => 'nullable|string|url',
            'tags' => 'nullable|array',
            'tags.*.id' => 'nullable|integer',
            'tags.*.name' => 'nullable|string|max:255',
            'status' => ['required', Rule::enum(PetStatus::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'pet name',
            'photoUrls' => 'photo URLs',
            'photoUrls.*' => 'photo URL',
        ];
    }
}
