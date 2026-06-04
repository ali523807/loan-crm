@extends('layouts.app')

@section('title', 'Leads')

@section('content')
    <div class="px-2 leads-page">
        <div class="leads-hero d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div>
                <span class="leads-eyebrow">Loan operations</span>
                <h1 class="leads-title">Loan Leads</h1>
                <p class="leads-subtitle mb-0">Track every frontend application from new lead to disbursement.</p>
            </div>
            <x-button link="{{ route('frontend.apply-loan') }}" color="dark">
                <x-lucide-external-link class="w-4 h-4"/>
                <span class="d-none d-sm-inline-block">Open Form</span>
            </x-button>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-sm-6 col-xl-3">
                <div class="lead-stat-card stat-total">
                    <span>Total Leads</span>
                    <strong>{{ $totalLeads }}</strong>
                    <small>All applications</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="lead-stat-card stat-warning">
                    <span>Docs Pending</span>
                    <strong>{{ $pendingDocuments }}</strong>
                    <small>Needs action</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="lead-stat-card stat-success">
                    <span>Docs Verified</span>
                    <strong>{{ $verifiedDocuments }}</strong>
                    <small>Ready for next stage</small>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="lead-stat-card stat-dark">
                    <span>Disbursed</span>
                    <strong>{{ $disbursedLeads }}</strong>
                    <small>Completed cases</small>
                </div>
            </div>
        </div>

        <x-card class="mt-3 lead-filter-card" body-class="pb-3">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-3">
                <div>
                    <h6 class="mb-1">Lead filters</h6>
                    <p class="text-muted mb-0 small">Narrow the queue by status or loan product.</p>
                </div>
                <button type="button" id="clear-lead-filters" class="btn btn-sm btn-outline-secondary">
                    Clear
                </button>
            </div>

            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select id="lead-status-filter" name="status" class="form-select">
                        <option value="">All statuses</option>
                        @foreach($statuses as $status => $label)
                            <option value="{{ $status }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Loan Type</label>
                    <select id="lead-type-filter" name="loan_type" class="form-select">
                        <option value="">All loan types</option>
                        @foreach($loanTypes as $loanType)
                            <option value="{{ $loanType }}">{{ $loanType }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-card>

        <x-card class="mt-3 lead-table-card" body-class="px-0 pt-0 pb-1">
            <div class="lead-table-header d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div>
                    <h6 class="mb-1">Application queue</h6>
                    <p class="text-muted mb-0 small">Newest applications appear first.</p>
                </div>
            </div>
            <div class="table-responsive">
                <x-table id="loan-applications-table" class="table table-borderless">
                    <thead>
                    <x-table.row>
                        <x-table.header>#</x-table.header>
                        <x-table.header>Application</x-table.header>
                        <x-table.header>Customer</x-table.header>
                        <x-table.header>Mobile</x-table.header>
                        <x-table.header>Loan Type</x-table.header>
                        <x-table.header>Amount</x-table.header>
                        <x-table.header>Status</x-table.header>
                        <x-table.header>Assigned To</x-table.header>
                        <x-table.header>Submitted</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                    </thead>
                    <tbody></tbody>
                </x-table>
            </div>
        </x-card>
    </div>
@endsection

@push('js')
    <script type="module">
        $(function () {
            const queryParams = new URLSearchParams(window.location.search);

            if (queryParams.has('status')) {
                $('#lead-status-filter').val(queryParams.get('status'));
            }

            if (queryParams.has('loan_type')) {
                $('#lead-type-filter').val(queryParams.get('loan_type'));
            }

            let table = $('#loan-applications-table').jpDataTable({
                url: route('loan-applications.index'),
                filters: ['#lead-status-filter', '#lead-type-filter'],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'application_number', name: 'application_number'},
                    {data: 'customer', name: 'customer'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'loan_type', name: 'loan_type'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status_badge', name: 'status'},
                    {data: 'assigned_to', name: 'assigned_to'},
                    {data: 'submitted', name: 'submitted_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $('#lead-status-filter, #lead-type-filter').on('change', function () {
                table.draw();
            });

            $('#clear-lead-filters').on('click', function () {
                $('#lead-status-filter, #lead-type-filter').val('');
                table.draw();
            });
        });
    </script>
@endpush
