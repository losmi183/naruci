<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ClientRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'pib' => 'required|digits:9',
            'country' => 'required|integer|exists:countries,id',
            'city' => 'required|integer|exists:cities,id',
            'Address' => 'required|string|max:255',
        ];
    }

    
    /**
     * @param Validator $validator
     *
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        abort(418, $validator->errors());
    }
}
