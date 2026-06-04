<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanApplicationRequest;
use App\Models\Customer;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ApplyLoanController extends Controller
{
    public function index(): mixed
    {
        return view('frontend.apply-loan');
    }

    public function store(StoreLoanApplicationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $customer = Customer::query()->updateOrCreate(
            ['mobile' => $data['mobile']],
            [
                'full_name' => $data['full_name'],
                'email' => $data['email'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'pan_number' => filled($data['pan_number'] ?? null) ? strtoupper($data['pan_number']) : null,
                'aadhaar_number' => $data['aadhaar_number'] ?? null,
                'address' => $data['address'] ?? null,
            ],
        );

        $application = LoanApplication::query()->create([
            'customer_id' => $customer->id,
            'application_number' => $this->generateApplicationNumber(),
            'status' => 'new_lead',
            'loan_type' => $data['loan_type'],
            'loan_amount' => $data['loan_amount'],
            'loan_tenure' => $data['loan_tenure'] ?? null,
            'loan_purpose' => $data['loan_purpose'] ?? null,
            'employment_type' => $data['employment_type'] ?? null,
            'company_name' => $data['company_name'] ?? null,
            'monthly_income' => $data['monthly_income'] ?? null,
            'existing_emi' => $data['existing_emi'] ?? null,
            'work_experience' => $data['work_experience'] ?? null,
            'contact_time' => $data['contact_time'] ?? null,
            'submitted_at' => now(),
        ]);

        $documentLabels = [
            'pan_card' => 'PAN Card',
            'aadhaar_card' => 'Aadhaar Card',
            'income_proof' => 'Income Proof',
            'bank_statement' => 'Bank Statement',
        ];

        foreach ($documentLabels as $field => $label) {
            if (! $request->hasFile($field)) {
                continue;
            }

            $file = $request->file($field);

            LoanDocument::query()->create([
                'loan_application_id' => $application->id,
                'type' => $label,
                'original_name' => $file->getClientOriginalName(),
                'path' => $file->store("loan-documents/{$application->application_number}", 'public'),
            ]);
        }

        return redirect()
            ->route('frontend.apply-loan')
            ->with('application_submitted', $application->application_number);
    }

    private function generateApplicationNumber(): string
    {
        do {
            $applicationNumber = 'LA-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
        } while (LoanApplication::query()->where('application_number', $applicationNumber)->exists());

        return $applicationNumber;
    }
}
