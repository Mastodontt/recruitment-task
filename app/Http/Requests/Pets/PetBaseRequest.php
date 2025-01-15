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
            'name' => 'required|string|max:255',
            'category.id' => 'required|integer',
            'category.name' => 'required|string|max:255',
            'photoUrls' => 'required|array|min:1',
            'photoUrls.*' => 'required|string|url',
            'tags' => 'nullable|array',
            'tags.*.id' => 'nullable|integer',
            'tags.*.name' => 'nullable|string|max:255',
            'status' => ['required', Rule::enum(PetStatus::class)],
        ];
    }
}
