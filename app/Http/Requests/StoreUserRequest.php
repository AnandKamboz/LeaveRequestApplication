<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'mobile' => ['required', 'digits:10' , 'unique:users,mobile'],
            'gender' => ['required', 'in:Male,Female'],
            // 'company_group_id' => ['required', 'in:SISL,HKCL,TCS,Infosys'],
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], 
            'date_of_joining' => ['nullable', 'date', 'before_or_equal:today'],
            'salary' => ['required', 'numeric', 'min:0'],
        ];
    }

     public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a valid string.',
            'first_name.max' => 'The first name must not exceed 50 characters.',

            'last_name.string' => 'The last name must be a valid string.',
            'last_name.max' => 'The last name must not exceed 50 characters.',

            'profile_photo.image' => 'The profile photo must be a valid image file.',
            'profile_photo.mimes' => 'The profile photo must be in JPG, JPEG, or PNG format.',
            'profile_photo.max' => 'The profile photo size must not exceed 2MB.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'email.max' => 'The email must not exceed 100 characters.',

            'phone.digits' => 'The phone number must be exactly 10 digits.',
            'phone.required' => 'The phone field is required.',

            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The selected gender must be either Male or Female.',

            'company_group.required' => 'The company group field is required.',
            'company_group.in' => 'The selected company group must be SISL, HKCL, TCS, or Infosys.',

            'date_of_joining.date' => 'The date of joining must be a valid date.',
            'date_of_joining.before_or_equal' => 'The date of joining cannot be a future date.',
            'salary.required' => 'The salary amount is required.',
            'salary.numeric' => 'The salary must be a valid number.',
            'salary.min' => 'The salary cannot be negative.',
        ];
    }
}
