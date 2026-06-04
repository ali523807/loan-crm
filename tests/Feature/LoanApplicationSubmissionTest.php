<?php

use App\Models\Customer;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(DatabaseTransactions::class);

it('creates a customer lead and uploaded document from the frontend form', function () {
    Storage::fake('public');

    $response = $this->post(route('frontend.apply-loan.store'), [
        'loan_type' => 'Personal Loan',
        'loan_amount' => 500000,
        'loan_tenure' => '36 Months',
        'loan_purpose' => 'Home renovation',
        'full_name' => 'Aarav Mehta',
        'mobile' => '9876543210',
        'email' => 'aarav@example.com',
        'employment_type' => 'Salaried',
        'monthly_income' => 85000,
        'contact_time' => 'Evening',
        'terms' => '1',
        'pan_card' => UploadedFile::fake()->image('pan.jpg'),
    ]);

    $response
        ->assertRedirect(route('frontend.apply-loan'))
        ->assertSessionHas('application_submitted');

    expect(Customer::query()->where('mobile', '9876543210')->exists())->toBeTrue()
        ->and(LoanApplication::query()->where('loan_type', 'Personal Loan')->exists())->toBeTrue()
        ->and(LoanDocument::query()->where('type', 'PAN Card')->exists())->toBeTrue();
});

it('requires consent before submitting a frontend application', function () {
    $this->post(route('frontend.apply-loan.store'), [
        'loan_type' => 'Personal Loan',
        'loan_amount' => 500000,
        'full_name' => 'Aarav Mehta',
        'mobile' => '9876543210',
    ])->assertSessionHasErrors('terms');
});
