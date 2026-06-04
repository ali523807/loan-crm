@php
    $colors = [
        'new_lead' => 'primary',
        'under_review' => 'info',
        'documents_pending' => 'warning',
        'documents_verified' => 'success',
        'financial_verification' => 'info',
        'field_verification' => 'secondary',
        'approved' => 'success',
        'rejected' => 'danger',
        'sanctioned' => 'primary',
        'agreement_signed' => 'dark',
        'disbursed' => 'success',
    ];
@endphp

<span class="badge text-bg-{{ $colors[$application->status] ?? 'secondary' }}">
    {{ $application->statusLabel() }}
</span>
