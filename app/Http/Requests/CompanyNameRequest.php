<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CompanyNameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/',
            Rule::unique('company_names', 'company_name')->ignore($this->route('id')) // Ignore current ID
        ],
            // 'company_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/|unique:company_names,company_name',
            'description' => 'nullable|string|max:255',
        ];
    }

     public function messages(): array
    {
        return [
            'company_name.required' => 'Company Name is required.',
            'company_name.string' => 'Company Name must be a valid text.',
            'company_name.max' => 'Company Name must not exceed 255 characters.',
            'company_name.regex' => 'Company Name must contain only letters and spaces.',
            'description.string' => 'Description must be a valid text.',
            'description.max' => 'Description must not exceed 255 characters.',
        ];
    }
}
