<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanGeneratedDocument extends Model
{
    /** @use HasFactory<\Database\Factories\LoanGeneratedDocumentFactory> */
    use HasFactory;

    public const TYPES = [
        'sanction_letter' => 'Sanction Letter',
        'disbursement_letter' => 'Disbursement Letter',
        'welcome_letter' => 'Welcome Letter',
        'repayment_schedule' => 'Repayment Schedule',
    ];

    protected $fillable = [
        'loan_application_id',
        'generated_by_id',
        'type',
        'document_number',
        'snapshot',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'snapshot' => 'array',
            'generated_at' => 'datetime',
        ];
    }

    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_id');
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? str($this->type)->headline()->toString();
    }
}
