<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationRequest extends FormRequest
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
            // 'name' => 'required|exists:employees,id',
            'name' => 'required',
            'designation' => 'required|string|max:255',
            'place_of_posting' => 'required|string|max:255',
            'leave_type' => 'required',
            'leave_from' => 'required|date|before_or_equal:leave_to',
            'leave_to' => 'required|date|after_or_equal:leave_from',
            'leave_address' => 'required|string|max:255',
            'leave_reason' => 'required|string|max:500',
        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'Please select an employee!',
            'designation.required' => 'Please enter a designation!',
            'place_of_posting.required' => 'Please enter a place of posting!',
            'leave_type.required' => 'Please select the type of leave!',
            'leave_from.required' => 'Please select the start date of leave!',
            'leave_to.required' => 'Please select the end date of leave!',
            'leave_from.before_or_equal' => 'The start date of leave must be before or equal to the end date!',
            'leave_to.after_or_equal' => 'The end date of leave must be after or equal to the start date!',
            'leave_address.required' => 'Please enter an address during leave!',
            'leave_reason.required' => 'Please provide a reason for the leave!',
        ];
    }
}
