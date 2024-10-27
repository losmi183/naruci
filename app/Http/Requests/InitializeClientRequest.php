<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class InitializeClientRequest extends FormRequest
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
            'company_id' => 'required|integer|exists:companies,id',
            'selected_categories' => 'nullable|array',
            'selected_categories.*' => 'required|integer|exists:category_blueprints,id',
            'selected_products' => 'nullable|array',
            'selected_products.*' => 'required|integer|exists:product_blueprints,id',
            'selected_additions' => 'nullable|array',
            'selected_additions.*' => 'required|integer|exists:addition_blueprints,id',
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
