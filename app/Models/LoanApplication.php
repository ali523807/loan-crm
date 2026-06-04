<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoanApplication extends Model
{
    /** @use HasFactory<\Database\Factories\LoanApplicationFactory> */
    use HasFactory;

    public const STATUSES = [
        'new_lead' => 'New Lead',
        'under_review' => 'Under Review',
        'documents_pending' => 'Documents Pending',
        'documents_verified' => 'Documents Verified',
        'financial_verification' => 'Financial Verification',
        'field_verification' => 'Field Verification',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'sanctioned' => 'Sanctioned',
        'agreement_signed' => 'Agreement Signed',
        'disbursed' => 'Disbursed',
    ];

    protected $fillable = [
        'customer_id',
        'assigned_to_id',
        'application_number',
        'status',
        'loan_type',
        'loan_amount',
        'loan_tenure',
        'loan_purpose',
        'employment_type',
        'company_name',
        'monthly_income',
        'existing_emi',
        'work_experience',
        'contact_time',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'loan_amount' => 'integer',
            'monthly_income' => 'integer',
            'existing_emi' => 'integer',
            'submitted_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(LoanDocument::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(LeadFollowUp::class);
    }

    public function generatedDocuments(): HasMany
    {
        return $this->hasMany(LoanGeneratedDocument::class);
    }

    public function communicationLogs(): HasMany
    {
        return $this->hasMany(CommunicationLog::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? str($this->status)->headline()->toString();
    }
}
