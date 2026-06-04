<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanDocument extends Model
{
    /** @use HasFactory<\Database\Factories\LoanDocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'uploaded_by_id',
        'verified_by_id',
        'type',
        'original_name',
        'path',
        'previous_path',
        'status',
        'remarks',
        'verified_at',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'uploaded_at' => 'datetime',
        ];
    }

    public function loanApplication(): BelongsTo
    {
        return $this->belongsTo(LoanApplication::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');
    }
}
