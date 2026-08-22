<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image_path' => ['nullable', 'image'],
            'name_product' => ['required'],
            //'reference' => ['required'],
            'price' => ['required'],
            'id_provider' => ['required'],
            'enter_date' => ['required', 'date'],
            'initial_quantity' => ['nullable'],
            'provider_price' => ['required'],
            'id_category' => ['required'],
            'size' => ['nullable'],
            'color' => ['nullable'],
            'matter' => ['nullable']
        ];
    }
}
