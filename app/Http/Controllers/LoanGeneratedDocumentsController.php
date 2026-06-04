<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanGeneratedDocumentRequest;
use App\Models\LoanApplication;
use App\Models\LoanGeneratedDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoanGeneratedDocumentsController extends Controller
{
    public function store(StoreLoanGeneratedDocumentRequest $request, LoanApplication $loanApplication): RedirectResponse
    {
        $loanApplication->load('customer');
        $data = $request->validated();
        $snapshot = $this->buildSnapshot($loanApplication, $data);

        $generatedDocument = LoanGeneratedDocument::query()->create([
            'loan_application_id' => $loanApplication->id,
            'generated_by_id' => $request->user()->id,
            'type' => $data['type'],
            'document_number' => $this->generateDocumentNumber($data['type']),
            'snapshot' => $snapshot,
            'generated_at' => now(),
        ]);

        return redirect()->route('loan-generated-documents.show', $generatedDocument);
    }

    public function show(LoanGeneratedDocument $loanGeneratedDocument): View
    {
        $loanGeneratedDocument->load(['loanApplication.customer', 'generatedBy']);

        return view('loan-generated-documents.show', [
            'document' => $loanGeneratedDocument,
            'application' => $loanGeneratedDocument->loanApplication,
            'customer' => $loanGeneratedDocument->loanApplication->customer,
            'snapshot' => $loanGeneratedDocument->snapshot,
            'schedule' => $this->repaymentSchedule($loanGeneratedDocument->snapshot),
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function buildSnapshot(LoanApplication $loanApplication, array $data): array
    {
        $principal = (int) $loanApplication->loan_amount;
        $annualRate = (float) ($data['annual_interest_rate'] ?? 10.5);
        $tenureMonths = $this->tenureMonths($loanApplication->loan_tenure);
        $monthlyRate = $annualRate / 12 / 100;
        $emi = $monthlyRate > 0
            ? (int) round(($principal * $monthlyRate * ((1 + $monthlyRate) ** $tenureMonths)) / (((1 + $monthlyRate) ** $tenureMonths) - 1))
            : (int) ceil($principal / max($tenureMonths, 1));

        return [
            'principal' => $principal,
            'annual_interest_rate' => $annualRate,
            'tenure_months' => $tenureMonths,
            'emi' => $emi,
            'processing_fee' => (int) ($data['processing_fee'] ?? 0),
            'disbursement_reference' => $data['disbursement_reference'] ?? 'TXN-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
            'bank_account_last_four' => $data['bank_account_last_four'] ?? '0000',
        ];
    }

    private function tenureMonths(?string $tenure): int
    {
        preg_match('/\d+/', (string) $tenure, $matches);

        return max((int) ($matches[0] ?? 36), 1);
    }

    private function generateDocumentNumber(string $type): string
    {
        do {
            $documentNumber = Str::upper(Str::slug($type, '')).'-'.now()->format('Ymd').'-'.Str::upper(Str::random(5));
        } while (LoanGeneratedDocument::query()->where('document_number', $documentNumber)->exists());

        return $documentNumber;
    }

    /**
     * @param  array<string, mixed>  $snapshot
     * @return array<int, array<string, int>>
     */
    private function repaymentSchedule(array $snapshot): array
    {
        $principal = (int) $snapshot['principal'];
        $emi = (int) $snapshot['emi'];
        $monthlyRate = ((float) $snapshot['annual_interest_rate']) / 12 / 100;
        $months = min((int) $snapshot['tenure_months'], 24);
        $balance = $principal;
        $schedule = [];

        for ($month = 1; $month <= $months; $month++) {
            $interest = (int) round($balance * $monthlyRate);
            $principalPaid = min($emi - $interest, $balance);
            $balance = max($balance - $principalPaid, 0);

            $schedule[] = [
                'month' => $month,
                'emi' => $emi,
                'principal' => $principalPaid,
                'interest' => $interest,
                'balance' => $balance,
            ];

            if ($balance === 0) {
                break;
            }
        }

        return $schedule;
    }
}
