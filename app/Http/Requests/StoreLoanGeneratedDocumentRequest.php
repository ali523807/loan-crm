<?php

namespace App\Http\Requests;

use App\Models\LoanGeneratedDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLoanGeneratedDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('generated-documents.manage') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(array_keys(LoanGeneratedDocument::TYPES))],
            'annual_interest_rate' => ['nullable', 'numeric', 'min:0', 'max:60'],
            'processing_fee' => ['nullable', 'integer', 'min:0', 'max:10000000'],
            'disbursement_reference' => ['nullable', 'string', 'max:100'],
            'bank_account_last_four' => ['nullable', 'digits:4'],
        ];
    }
}
