<?php

use App\Models\CommunicationLog;
use App\Models\CommunicationTemplate;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use App\Models\LoanGeneratedDocument;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->seed(RolesAndPermissionsSeeder::class);
    $this->seed(\Database\Seeders\CommunicationTemplateSeeder::class);
});

it('allows lead users to view loan applications', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    LoanApplication::factory()->create();

    $this->actingAs($user)
        ->get(route('loan-applications.index'))
        ->assertOk()
        ->assertSee('Loan Leads');
});

it('shows the crm dashboard widgets', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    LoanApplication::factory()->create();

    $this->actingAs($user)
        ->get(route('home'))
        ->assertOk()
        ->assertSee('Loan CRM Dashboard')
        ->assertSee('Recent Leads')
        ->assertSee('Document Issues');
});

it('shows lead detail and customer record pages', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create();

    $this->actingAs($user)
        ->get(route('loan-applications.show', $application))
        ->assertOk()
        ->assertSee($application->application_number)
        ->assertSee('Customer Record');

    $this->actingAs($user)
        ->get(route('customers.show', $application->customer))
        ->assertOk()
        ->assertSee($application->customer->full_name)
        ->assertSee('Loan Applications');
});

it('updates lead status and stores follow ups', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create();

    $this->actingAs($user)
        ->post(route('loan-applications.status', $application), [
            'status' => 'under_review',
            'assigned_to_id' => $user->id,
        ])
        ->assertRedirect();

    $application->refresh();

    expect($application->status)->toBe('under_review')
        ->and($application->assigned_to_id)->toBe($user->id);

    $this->actingAs($user)
        ->post(route('loan-applications.follow-ups.store', $application), [
            'type' => 'call',
            'note' => 'Customer asked for document guidance.',
        ])
        ->assertRedirect();

    expect($application->followUps()->where('type', 'call')->exists())->toBeTrue();
});

it('allows verification officers to update document statuses', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'verification-officer')->value('id'));

    $application = LoanApplication::factory()->create();
    $document = LoanDocument::factory()->create([
        'loan_application_id' => $application->id,
        'status' => 'pending',
    ]);

    $this->actingAs($user)
        ->post(route('loan-applications.documents.status', [$application, $document]), [
            'status' => 'verified',
            'remarks' => 'Matched with customer profile.',
        ])
        ->assertRedirect();

    $document->refresh();

    expect($document->status)->toBe('verified')
        ->and($document->remarks)->toBe('Matched with customer profile.')
        ->and($document->verified_by_id)->toBe($user->id)
        ->and($document->verified_at)->not->toBeNull();
});

it('allows permitted users to upload and replace lead documents', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create([
        'status' => 'documents_verified',
    ]);

    $this->actingAs($user)
        ->post(route('loan-applications.documents.store', $application), [
            'type' => 'Income Proof',
            'document' => UploadedFile::fake()->create('income.pdf', 120, 'application/pdf'),
            'remarks' => 'Uploaded latest salary slip.',
        ])
        ->assertRedirect();

    $document = LoanDocument::query()->where('loan_application_id', $application->id)->where('type', 'Income Proof')->firstOrFail();
    $firstPath = $document->path;

    expect($document->status)->toBe('pending')
        ->and($document->uploaded_by_id)->toBe($user->id)
        ->and($document->remarks)->toBe('Uploaded latest salary slip.');

    $this->actingAs($user)
        ->post(route('loan-applications.documents.store', $application), [
            'type' => 'Income Proof',
            'document' => UploadedFile::fake()->create('income-updated.pdf', 140, 'application/pdf'),
        ])
        ->assertRedirect();

    $document->refresh();

    expect($document->path)->not->toBe($firstPath)
        ->and($document->previous_path)->toBe($firstPath)
        ->and($application->refresh()->status)->toBe('documents_pending');
});

it('generates and opens printable loan letters', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create([
        'loan_amount' => 600000,
        'loan_tenure' => '36 Months',
    ]);

    $response = $this->actingAs($user)
        ->post(route('loan-applications.generated-documents.store', $application), [
            'type' => 'sanction_letter',
            'annual_interest_rate' => 11.25,
            'processing_fee' => 2500,
        ]);

    $generatedDocument = LoanGeneratedDocument::query()
        ->where('loan_application_id', $application->id)
        ->firstOrFail();

    $response->assertRedirect(route('loan-generated-documents.show', $generatedDocument));

    expect($generatedDocument->type)->toBe('sanction_letter')
        ->and($generatedDocument->snapshot['principal'])->toBe(600000)
        ->and($generatedDocument->snapshot['annual_interest_rate'])->toBe(11.25);

    $this->actingAs($user)
        ->get(route('loan-generated-documents.show', $generatedDocument))
        ->assertOk()
        ->assertSee('Sanction Letter')
        ->assertSee($application->application_number);
});

it('sends email communications and stores the log', function () {
    Mail::fake();

    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create();
    $template = CommunicationTemplate::query()->where('name', 'Status Update')->firstOrFail();

    $this->actingAs($user)
        ->post(route('loan-applications.communications.store', $application), [
            'communication_template_id' => $template->id,
            'channel' => 'email',
        ])
        ->assertRedirect();

    expect(CommunicationLog::query()->where('channel', 'email')->where('status', 'sent')->exists())->toBeTrue();
});

it('prepares whatsapp communications and stores the log', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $application = LoanApplication::factory()->create();
    $template = CommunicationTemplate::query()->where('name', 'Missing Documents')->firstOrFail();

    $this->actingAs($user)
        ->post(route('loan-applications.communications.store', $application), [
            'communication_template_id' => $template->id,
            'channel' => 'whatsapp',
        ])
        ->assertRedirect();

    expect(CommunicationLog::query()->where('channel', 'whatsapp')->where('status', 'prepared')->exists())->toBeTrue();
});
