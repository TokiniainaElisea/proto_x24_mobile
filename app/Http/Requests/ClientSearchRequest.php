<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSearchRequest extends FormRequest
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
            'name' => ['nullable'],
            'firstname' => ['nullable'],
            'phone' => ['nullable', 'numeric'],
            'client_number' => ['nullable']
        ];
    }
}
