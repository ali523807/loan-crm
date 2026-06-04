<?php

namespace Database\Seeders;

use App\Models\CommunicationLog;
use App\Models\CommunicationTemplate;
use App\Models\Customer;
use App\Models\LeadFollowUp;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use App\Models\LoanGeneratedDocument;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LoanCrmDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            ['name' => 'Meera Sharma', 'email' => 'manager@loancrm.test', 'role' => 'manager'],
            ['name' => 'Rohan Verma', 'email' => 'sales@loancrm.test', 'role' => 'sales-executive'],
            ['name' => 'Nisha Khan', 'email' => 'verification@loancrm.test', 'role' => 'verification-officer'],
            ['name' => 'Arjun Rao', 'email' => 'finance@loancrm.test', 'role' => 'finance-officer'],
        ];

        foreach ($admins as $adminData) {
            $user = User::query()->updateOrCreate(
                ['email' => $adminData['email']],
                [
                    'name' => $adminData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'active' => true,
                ],
            );

            $roleId = Role::query()->where('name', $adminData['role'])->value('id');

            if ($roleId) {
                $user->roles()->syncWithoutDetaching([$roleId]);
            }
        }

        $customers = [
            [
                'profile' => ['full_name' => 'Aarav Mehta', 'mobile' => '9876543210', 'email' => 'aarav.mehta@example.com', 'date_of_birth' => '1991-04-12', 'pan_number' => 'ABCDE1234F', 'aadhaar_number' => '491827364512', 'address' => 'Bandra West, Mumbai, Maharashtra 400050'],
                'loan' => ['Personal Loan', 550000, '36 Months', 'Home renovation', 'Salaried', 'BluePeak Technologies', 88000, 12000, '6 years', 'Evening', 'new_lead'],
            ],
            [
                'profile' => ['full_name' => 'Priya Nair', 'mobile' => '9876543211', 'email' => 'priya.nair@example.com', 'date_of_birth' => '1988-09-22', 'pan_number' => 'PQRST4567L', 'aadhaar_number' => '729104856321', 'address' => 'Indiranagar, Bengaluru, Karnataka 560038'],
                'loan' => ['Business Loan', 1800000, '60 Months', 'Inventory expansion', 'Business Owner', 'Nair Foods', 240000, 35000, '9 years', 'Morning', 'documents_pending'],
            ],
            [
                'profile' => ['full_name' => 'Kabir Singh', 'mobile' => '9876543212', 'email' => 'kabir.singh@example.com', 'date_of_birth' => '1994-01-08', 'pan_number' => 'LMNOP9876Q', 'aadhaar_number' => '658291047365', 'address' => 'Sector 62, Noida, Uttar Pradesh 201309'],
                'loan' => ['Vehicle Finance', 920000, '48 Months', 'Commercial vehicle purchase', 'Self Employed', 'Singh Logistics', 135000, 22000, '5 years', 'Afternoon', 'documents_verified'],
            ],
            [
                'profile' => ['full_name' => 'Sneha Iyer', 'mobile' => '9876543213', 'email' => 'sneha.iyer@example.com', 'date_of_birth' => '1986-06-30', 'pan_number' => 'IYERS4321K', 'aadhaar_number' => '780145923614', 'address' => 'Adyar, Chennai, Tamil Nadu 600020'],
                'loan' => ['Home Loan', 5200000, '120 Months', 'Apartment purchase', 'Salaried', 'Axis Media Labs', 310000, 58000, '11 years', 'Morning', 'financial_verification'],
            ],
            [
                'profile' => ['full_name' => 'Dev Patel', 'mobile' => '9876543214', 'email' => 'dev.patel@example.com', 'date_of_birth' => '1990-12-19', 'pan_number' => 'DEVPA2468M', 'aadhaar_number' => '361478205912', 'address' => 'Navrangpura, Ahmedabad, Gujarat 380009'],
                'loan' => ['Gold Loan', 320000, '24 Months', 'Working capital bridge', 'Professional', 'Patel Consulting', 155000, 8000, '7 years', 'Evening', 'approved'],
            ],
            [
                'profile' => ['full_name' => 'Fatima Ansari', 'mobile' => '9876543215', 'email' => 'fatima.ansari@example.com', 'date_of_birth' => '1992-03-15', 'pan_number' => 'ANSAR1357P', 'aadhaar_number' => '581302946721', 'address' => 'Park Street, Kolkata, West Bengal 700016'],
                'loan' => ['Education Loan', 950000, '60 Months', 'Postgraduate education', 'Salaried', 'Eastern Retail Co', 72000, 5000, '4 years', 'Afternoon', 'disbursed'],
            ],
        ];

        $assignees = User::query()
            ->whereIn('email', ['manager@loancrm.test', 'sales@loancrm.test', 'verification@loancrm.test', 'finance@loancrm.test'])
            ->get()
            ->values();

        $documentTypes = ['PAN Card', 'Aadhaar Card', 'Income Proof', 'Bank Statement'];
        $documentStatusMap = [
            'new_lead' => ['pending', 'pending', 'pending', 'pending'],
            'documents_pending' => ['verified', 'missing', 'pending', 'rejected'],
            'documents_verified' => ['verified', 'verified', 'verified', 'verified'],
            'financial_verification' => ['verified', 'verified', 'verified', 'verified'],
            'approved' => ['verified', 'verified', 'verified', 'verified'],
            'disbursed' => ['verified', 'verified', 'verified', 'verified'],
        ];

        foreach ($customers as $index => $customerData) {
            $customer = Customer::query()->updateOrCreate(
                ['mobile' => $customerData['profile']['mobile']],
                $customerData['profile'],
            );

            $loanData = $customerData['loan'];
            $application = LoanApplication::query()->updateOrCreate(
                ['application_number' => 'LA-DEMO-'.str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'assigned_to_id' => $assignees->get($index % max($assignees->count(), 1))?->id,
                    'status' => $loanData[10],
                    'loan_type' => $loanData[0],
                    'loan_amount' => $loanData[1],
                    'loan_tenure' => $loanData[2],
                    'loan_purpose' => $loanData[3],
                    'employment_type' => $loanData[4],
                    'company_name' => $loanData[5],
                    'monthly_income' => $loanData[6],
                    'existing_emi' => $loanData[7],
                    'work_experience' => $loanData[8],
                    'contact_time' => $loanData[9],
                    'submitted_at' => now()->subDays(8 - $index),
                ],
            );

            foreach ($documentTypes as $documentIndex => $documentType) {
                $path = 'loan-documents/'.$application->application_number.'/'.Str::slug($documentType).'.txt';
                Storage::disk('public')->put($path, $documentType.' demo document for '.$customer->full_name);

                $documentStatus = $documentStatusMap[$application->status][$documentIndex] ?? 'pending';

                LoanDocument::query()->updateOrCreate(
                    [
                        'loan_application_id' => $application->id,
                        'type' => $documentType,
                    ],
                    [
                        'original_name' => Str::slug($documentType).'-'.$customer->mobile.'.txt',
                        'path' => $path,
                        'status' => $documentStatus,
                        'remarks' => match ($documentStatus) {
                            'verified' => 'Document reviewed and accepted.',
                            'missing' => 'Customer needs to upload a clearer copy.',
                            'rejected' => 'Document does not match submitted profile.',
                            default => null,
                        },
                        'verified_by_id' => $documentStatus === 'verified' ? User::query()->where('email', 'verification@loancrm.test')->value('id') : null,
                        'verified_at' => $documentStatus === 'verified' ? now()->subDays(2) : null,
                    ],
                );
            }

            LeadFollowUp::query()->updateOrCreate(
                [
                    'loan_application_id' => $application->id,
                    'type' => 'call',
                ],
                [
                    'user_id' => $application->assigned_to_id,
                    'note' => 'Initial call completed. Customer informed about the next verification step.',
                    'next_follow_up_at' => now()->addDays($index + 1)->setTime(11, 0),
                ],
            );

            $this->generateSampleLetters($application);
            $this->generateSampleCommunications($application);
        }
    }

    private function generateSampleCommunications(LoanApplication $application): void
    {
        $application->loadMissing('customer');
        $template = CommunicationTemplate::query()->where('name', 'Status Update')->first();

        if (! $template) {
            return;
        }

        CommunicationLog::query()->updateOrCreate(
            [
                'loan_application_id' => $application->id,
                'communication_template_id' => $template->id,
                'channel' => 'email',
            ],
            [
                'sent_by_id' => User::query()->where('email', 'sales@loancrm.test')->value('id'),
                'recipient' => $application->customer->email ?? $application->customer->mobile,
                'subject' => 'Loan application '.$application->application_number.' status update',
                'message' => 'Dear '.$application->customer->full_name.",\n\nYour application is currently marked as ".$application->statusLabel().".\n\nRegards,\n".config('app.name'),
                'status' => 'sent',
                'sent_at' => now()->subHours(8),
            ],
        );
    }

    private function generateSampleLetters(LoanApplication $application): void
    {
        $types = match ($application->status) {
            'approved' => ['sanction_letter'],
            'disbursed' => ['sanction_letter', 'disbursement_letter', 'welcome_letter', 'repayment_schedule'],
            default => [],
        };

        foreach ($types as $type) {
            LoanGeneratedDocument::query()->updateOrCreate(
                [
                    'loan_application_id' => $application->id,
                    'type' => $type,
                ],
                [
                    'generated_by_id' => User::query()->where('email', 'manager@loancrm.test')->value('id'),
                    'document_number' => $this->sampleDocumentNumber($application, $type),
                    'snapshot' => $this->sampleDocumentSnapshot($application, $type),
                    'generated_at' => now()->subDay(),
                ],
            );
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function sampleDocumentSnapshot(LoanApplication $application, string $type): array
    {
        $principal = (int) $application->loan_amount;
        $annualRate = match ($application->loan_type) {
            'Gold Loan' => 9.25,
            'Education Loan' => 10.75,
            default => 10.5,
        };
        $tenureMonths = $this->tenureMonths($application->loan_tenure);
        $monthlyRate = $annualRate / 12 / 100;
        $emi = $monthlyRate > 0
            ? (int) round(($principal * $monthlyRate * ((1 + $monthlyRate) ** $tenureMonths)) / (((1 + $monthlyRate) ** $tenureMonths) - 1))
            : (int) ceil($principal / max($tenureMonths, 1));

        return [
            'principal' => $principal,
            'annual_interest_rate' => $annualRate,
            'tenure_months' => $tenureMonths,
            'emi' => $emi,
            'processing_fee' => $type === 'sanction_letter' ? 2500 : 0,
            'disbursement_reference' => 'DEMO-TXN-'.$application->application_number,
            'bank_account_last_four' => match ($application->application_number) {
                'LA-DEMO-0005' => '2468',
                'LA-DEMO-0006' => '1357',
                default => '0000',
            },
        ];
    }

    private function tenureMonths(?string $tenure): int
    {
        preg_match('/\d+/', (string) $tenure, $matches);

        return max((int) ($matches[0] ?? 36), 1);
    }

    private function sampleDocumentNumber(LoanApplication $application, string $type): string
    {
        return 'DEMO-'.Str::upper(Str::slug($type, '')).'-'.$application->application_number;
    }
}
