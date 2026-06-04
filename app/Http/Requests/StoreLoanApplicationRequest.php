<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLoanApplicationRequest extends FormRequest
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
        $documentRules = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];

        return [
            'loan_type' => ['required', 'string', 'max:100'],
            'loan_amount' => ['required', 'integer', 'min:10000', 'max:100000000'],
            'loan_tenure' => ['nullable', 'string', 'max:100'],
            'loan_purpose' => ['nullable', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10'],
            'email' => ['nullable', 'email', 'max:255'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'pan_number' => ['nullable', 'string', 'max:20'],
            'aadhaar_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:1000'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'monthly_income' => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'existing_emi' => ['nullable', 'integer', 'min:0', 'max:100000000'],
            'work_experience' => ['nullable', 'string', 'max:100'],
            'contact_time' => ['nullable', Rule::in(['Morning', 'Afternoon', 'Evening'])],
            'terms' => ['accepted'],
            'pan_card' => $documentRules,
            'aadhaar_card' => $documentRules,
            'income_proof' => $documentRules,
            'bank_statement' => $documentRules,
        ];
    }

    public function messages(): array
    {
        return [
            'terms.accepted' => 'Please confirm the consent before submitting your application.',
            'mobile.digits' => 'Please enter a valid 10 digit mobile number.',
        ];
    }
}
