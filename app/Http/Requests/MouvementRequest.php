<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MouvementRequest extends FormRequest
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
            'product_id' => ['required'],
            'enter_date' => ['required', 'date'],
            'initial_quantity' => ['integer', 'required'],
            'provider_price' => ['required', 'numeric']
        ];
    }
}
