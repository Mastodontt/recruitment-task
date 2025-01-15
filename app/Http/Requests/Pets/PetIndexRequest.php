<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;

final class PetIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
