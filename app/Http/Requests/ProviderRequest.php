<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            //
            'name_provider' => ['required'],
            'mail'          => ['nullable', 'email'],
            'phone'         => ['nullable'],
            'adress'        => ['nullable'],
            'town'          => ['nullable'],
            'pays'          => ['nullable'],
            'name_contact'  => ['nullable'],
            'note'          => ['nullable'],
        ];
    }
}