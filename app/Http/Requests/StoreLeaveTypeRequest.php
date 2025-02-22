<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveTypeRequest extends FormRequest
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
            'leave_type' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'max_days'   => 'required|integer|min:1|max:365',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'leave_type.required' => 'The leave type field is required.',
            'leave_type.string' => 'The leave type must be a valid string.',
            'leave_type.max' => 'The leave type must not exceed 100 characters.',
            'leave_type.regex' => 'The leave type should contain only letters and spaces.',

            'max_days.required' => 'The max days field is required.',
            'max_days.integer' => 'The max days must be a valid number.',
            'max_days.min' => 'The max days must be at least 1.',
            'max_days.max' => 'The max days cannot be more than 365.',

            'description.max' => 'The description must not exceed 255 characters.',
        ];
    }
}
