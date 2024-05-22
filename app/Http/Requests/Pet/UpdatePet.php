<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'status' => 'string|in:available,pending,sold|nullable',
            'file' => 'mimes:jpg,png,jpeg',
        ];
    }
}
