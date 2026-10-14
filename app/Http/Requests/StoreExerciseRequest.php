<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'sets' => ['required', 'integer', 'min:1', 'max:100'],
            'reps' => ['required', 'integer', 'min:1', 'max:1000'],
            'weight_kg' => ['nullable', 'numeric', 'min:0', 'max:9999'],
        ];
    }
}
