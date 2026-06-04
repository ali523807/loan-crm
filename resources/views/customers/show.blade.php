@extends('layouts.app')

@section('title', $customer->full_name)

@section('content')
    <div class="px-2">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-3">
            <div>
                <x-heading>{{ $customer->full_name }}</x-heading>
                <x-text>{{ $customer->mobile }} - {{ $customer->email ?? 'No email added' }}</x-text>
            </div>
            <x-button link="{{ route('customers.index') }}" color="light">
                <x-lucide-arrow-left class="w-4 h-4"/>
                Back
            </x-button>
        </div>

        <div class="row g-3">
            <div class="col-lg-4">
                <x-card title="Profile">
                    <div class="mb-3">
                        <div class="text-muted small">PAN</div>
                        <div>{{ $customer->pan_number ?? '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">Aadhaar</div>
                        <div>{{ $customer->aadhaar_number ?? '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">Date of Birth</div>
                        <div>{{ $customer->date_of_birth?->format('d M Y') ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-muted small">Address</div>
                        <div>{{ $customer->address ?? '-' }}</div>
                    </div>
                </x-card>
            </div>

            <div class="col-lg-8">
                <x-card title="Loan Applications">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th>Application</th>
                                <th>Loan Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($customer->loanApplications as $application)
                                <tr>
                                    <td>{{ $application->application_number }}</td>
                                    <td>{{ $application->loan_type }}</td>
                                    <td>Rs. {{ number_format($application->loan_amount) }}</td>
                                    <td>@include('loan-applications.columns._status', ['application' => $application])</td>
                                    <td>
                                        <a href="{{ route('loan-applications.show', $application) }}" class="btn btn-sm btn-outline-primary">Open</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted">No applications found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
@endsection
