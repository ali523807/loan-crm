@extends('layouts.app')

@section('title', 'Dashboard')

@php
    $money = fn (int|float|null $amount): string => 'Rs. '.number_format((float) ($amount ?? 0));
    $statusLinks = [
        'new_lead' => ['label' => 'New Leads', 'color' => 'primary'],
        'documents_pending' => ['label' => 'Docs Pending', 'color' => 'warning'],
        'approved' => ['label' => 'Approved', 'color' => 'success'],
        'disbursed' => ['label' => 'Disbursed', 'color' => 'dark'],
    ];
@endphp

@section('content')
    <div class="px-2 dashboard-page">
        <div class="dashboard-hero d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div>
                <span class="dashboard-eyebrow">Daily control room</span>
                <h1 class="dashboard-title">Loan CRM Dashboard</h1>
                <p class="dashboard-subtitle mb-0">Follow leads, documents, callbacks, and disbursement progress from one place.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('loan-applications.index') }}" class="btn btn-dark">
                    <x-lucide-list-checks class="w-4 h-4"/>
                    Leads
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    <x-lucide-users class="w-4 h-4"/>
                    Customers
                </a>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-blue">
                    <span>Total Leads</span>
                    <strong>{{ $totalLeads }}</strong>
                    <small>{{ $totalCustomers }} customers</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-amber">
                    <span>Document Queue</span>
                    <strong>{{ $documentsPending }}</strong>
                    <small>Pending, missing, or rejected</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-green">
                    <span>Disbursed Value</span>
                    <strong>{{ $money($disbursedAmount) }}</strong>
                    <small>Completed applications</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-slate">
                    <span>Generated Output</span>
                    <strong>{{ $generatedDocumentsCount }}</strong>
                    <small>{{ $communicationCount }} communications</small>
                </div>
            </div>
        </div>

        <div class="quick-link-strip mt-3">
            @foreach($statusLinks as $status => $item)
                <a href="{{ route('loan-applications.index') }}?status={{ $status }}">
                    <span class="badge text-bg-{{ $item['color'] }}">{{ $statusCounts[$status] ?? 0 }}</span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="row g-3 mt-1">
            <div class="col-xl-7">
                <x-card class="dashboard-panel" title="Recent Leads">
                    <div class="table-responsive">
                        <table class="table align-middle dashboard-table">
                            <thead>
                            <tr>
                                <th>Application</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentLeads as $lead)
                                <tr>
                                    <td>
                                        <strong>{{ $lead->application_number }}</strong>
                                        <div class="small text-muted">{{ $lead->loan_type }}</div>
                                    </td>
                                    <td>
                                        {{ $lead->customer->full_name }}
                                        <div class="small text-muted">{{ $lead->assignedTo?->name ?? 'Unassigned' }}</div>
                                    </td>
                                    <td>{{ $money($lead->loan_amount) }}</td>
                                    <td>@include('loan-applications.columns._status', ['application' => $lead])</td>
                                    <td>
                                        <a href="{{ route('loan-applications.show', $lead) }}" class="btn btn-sm btn-outline-primary">Open</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted">No leads found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>

            <div class="col-xl-5">
                <x-card class="dashboard-panel" title="Document Issues">
                    @forelse($documentIssues as $document)
                        <div class="work-item">
                            <div>
                                <strong>{{ $document->type }}</strong>
                                <div class="small text-muted">
                                    {{ $document->loanApplication->application_number }} - {{ $document->loanApplication->customer->full_name }}
                                </div>
                                @if($document->remarks)
                                    <div class="small text-muted">{{ $document->remarks }}</div>
                                @endif
                            </div>
                            <a href="{{ route('loan-applications.show', $document->loanApplication) }}" class="btn btn-sm btn-light">Review</a>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No missing or rejected documents.</p>
                    @endforelse
                </x-card>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-xl-4">
                <x-card class="dashboard-panel" title="Today Follow-ups">
                    @forelse($todayFollowUps as $followUp)
                        <div class="work-item">
                            <div>
                                <strong>{{ $followUp->loanApplication->customer->full_name }}</strong>
                                <div class="small text-muted">{{ $followUp->next_follow_up_at?->format('h:i A') }} - {{ str($followUp->type)->headline() }}</div>
                            </div>
                            <a href="{{ route('loan-applications.show', $followUp->loanApplication) }}" class="btn btn-sm btn-light">Open</a>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No follow-ups due today.</p>
                    @endforelse
                </x-card>
            </div>

            <div class="col-xl-4">
                <x-card class="dashboard-panel" title="Overdue Follow-ups">
                    @forelse($overdueFollowUps as $followUp)
                        <div class="work-item overdue">
                            <div>
                                <strong>{{ $followUp->loanApplication->customer->full_name }}</strong>
                                <div class="small text-muted">{{ $followUp->next_follow_up_at?->format('d M Y, h:i A') }}</div>
                            </div>
                            <a href="{{ route('loan-applications.show', $followUp->loanApplication) }}" class="btn btn-sm btn-light">Open</a>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No overdue follow-ups.</p>
                    @endforelse
                </x-card>
            </div>

            <div class="col-xl-4">
                <x-card class="dashboard-panel" title="Assigned Leads">
                    @forelse($assignedLeads as $admin)
                        <div class="assignment-row">
                            <div>
                                <strong>{{ $admin->name }}</strong>
                                <div class="small text-muted">{{ $admin->email }}</div>
                            </div>
                            <span>{{ $admin->assigned_loan_applications_count }}</span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No assigned leads yet.</p>
                    @endforelse
                </x-card>
            </div>
        </div>
    </div>
@endsection
