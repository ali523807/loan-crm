@extends('layouts.app')

@section('title', $application->application_number)

@section('content')
    <div class="px-2">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-3">
            <div>
                <x-heading>{{ $application->application_number }}</x-heading>
                <x-text>{{ $application->customer->full_name }} - {{ $application->loan_type }}</x-text>
            </div>
            <x-button link="{{ route('loan-applications.index') }}" color="light">
                <x-lucide-arrow-left class="w-4 h-4"/>
                Back
            </x-button>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <x-card title="Application Summary">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-muted small">Status</div>
                            @include('loan-applications.columns._status', ['application' => $application])
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Requested Amount</div>
                            <div class="fw-bold">Rs. {{ number_format($application->loan_amount) }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Tenure</div>
                            <div class="fw-bold">{{ $application->loan_tenure ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Purpose</div>
                            <div>{{ $application->loan_purpose ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Assigned To</div>
                            <div>{{ $application->assignedTo?->name ?? 'Unassigned' }}</div>
                        </div>
                    </div>
                </x-card>

                <x-card class="mt-3" title="Customer Record">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-muted small">Full Name</div>
                            <div class="fw-bold">{{ $application->customer->full_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Mobile</div>
                            <div>{{ $application->customer->mobile }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Email</div>
                            <div>{{ $application->customer->email ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">PAN</div>
                            <div>{{ $application->customer->pan_number ?? '-' }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Address</div>
                            <div>{{ $application->customer->address ?? '-' }}</div>
                        </div>
                    </div>
                </x-card>

                <x-card class="mt-3" title="Income & Employment">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-muted small">Employment</div>
                            <div>{{ $application->employment_type ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Company</div>
                            <div>{{ $application->company_name ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Monthly Income</div>
                            <div>{{ $application->monthly_income ? 'Rs. '.number_format($application->monthly_income) : '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Existing EMI</div>
                            <div>{{ $application->existing_emi ? 'Rs. '.number_format($application->existing_emi) : '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Experience</div>
                            <div>{{ $application->work_experience ?? '-' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Contact Time</div>
                            <div>{{ $application->contact_time ?? '-' }}</div>
                        </div>
                    </div>
                </x-card>

                <x-card class="mt-3" title="Documents">
                    @php
                        $documentEmptyColspan = auth()->user()?->can('documents.verify') ? 5 : 4;
                    @endphp

                    @can('documents.upload')
                        <form action="{{ route('loan-applications.documents.store', $application) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="border rounded p-3 mb-3 bg-light">
                            @csrf
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Document Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="PAN Card">PAN Card</option>
                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                        <option value="Income Proof">Income Proof</option>
                                        <option value="Bank Statement">Bank Statement</option>
                                        <option value="Address Proof">Address Proof</option>
                                        <option value="Signed Agreement">Signed Agreement</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Upload File</label>
                                    <input type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Optional">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">
                                        <x-lucide-upload class="w-4 h-4"/>
                                        Upload / Replace Document
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endcan

                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                @can('documents.verify')
                                    <th>Verify</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($application->documents as $document)
                                <tr>
                                    <td>{{ $document->type }}</td>
                                    <td>
                                        <a href="{{ Storage::url($document->path) }}" target="_blank">
                                            {{ $document->original_name }}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $documentStatusColors = [
                                                'pending' => 'secondary',
                                                'verified' => 'success',
                                                'rejected' => 'danger',
                                                'missing' => 'warning',
                                            ];
                                        @endphp
                                        <span class="badge text-bg-{{ $documentStatusColors[$document->status] ?? 'secondary' }}">
                                            {{ str($document->status)->headline() }}
                                        </span>
                                        @if($document->uploadedBy)
                                            <div class="small text-muted mt-1">
                                                Uploaded by {{ $document->uploadedBy->name }}
                                            </div>
                                        @endif
                                        @if($document->verifiedBy)
                                            <div class="small text-muted mt-1">
                                                By {{ $document->verifiedBy->name }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $document->remarks ?? '-' }}
                                        @if($document->uploaded_at)
                                            <div class="small text-muted mt-1">
                                                Uploaded {{ $document->uploaded_at->format('d M Y, h:i A') }}
                                            </div>
                                        @endif
                                        @if($document->previous_path)
                                            <a href="{{ Storage::url($document->previous_path) }}" target="_blank" class="small">
                                                Previous file
                                            </a>
                                        @endif
                                    </td>
                                    @can('documents.verify')
                                        <td style="min-width: 260px;">
                                            <form action="{{ route('loan-applications.documents.status', [$application, $document]) }}"
                                                  method="POST"
                                                  class="d-flex flex-column gap-2">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm">
                                                    <option value="pending" @selected($document->status === 'pending')>Pending</option>
                                                    <option value="verified" @selected($document->status === 'verified')>Verified</option>
                                                    <option value="missing" @selected($document->status === 'missing')>Missing</option>
                                                    <option value="rejected" @selected($document->status === 'rejected')>Rejected</option>
                                                </select>
                                                <input type="text"
                                                       name="remarks"
                                                       value="{{ $document->remarks }}"
                                                       class="form-control form-control-sm"
                                                       placeholder="Remarks">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $documentEmptyColspan }}" class="text-muted">No documents uploaded yet.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>

            <div class="col-lg-4">
                @can('leads.manage')
                    <x-card title="Update Lead">
                        <form action="{{ route('loan-applications.status', $application) }}" method="POST">
                            @csrf
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select mb-3">
                                @foreach($statuses as $status => $label)
                                    <option value="{{ $status }}" @selected($application->status === $status)>{{ $label }}</option>
                                @endforeach
                            </select>

                            <label class="form-label">Assigned To</label>
                            <select name="assigned_to_id" class="form-select mb-3">
                                <option value="">Unassigned</option>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}" @selected($application->assigned_to_id === $admin->id)>{{ $admin->name }}</option>
                                @endforeach
                            </select>

                            <x-button type="submit" color="primary" class="w-100">Save Changes</x-button>
                        </form>
                    </x-card>
                @endcan

                @can('generated-documents.manage')
                    <x-card class="mt-3" title="Generate Letters">
                        <form action="{{ route('loan-applications.generated-documents.store', $application) }}" method="POST">
                            @csrf

                            <label class="form-label">Letter Type</label>
                            <select name="type" class="form-select mb-3">
                                <option value="sanction_letter">Sanction Letter</option>
                                <option value="disbursement_letter">Disbursement Letter</option>
                                <option value="welcome_letter">Welcome Letter</option>
                                <option value="repayment_schedule">Repayment Schedule</option>
                            </select>

                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label">Rate %</label>
                                    <input type="number" step="0.01" name="annual_interest_rate" value="10.5" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Fee</label>
                                    <input type="number" name="processing_fee" value="0" class="form-control">
                                </div>
                            </div>

                            <label class="form-label mt-3">Disbursement Ref.</label>
                            <input type="text" name="disbursement_reference" class="form-control mb-3" placeholder="Optional">

                            <label class="form-label">Bank A/c Last 4</label>
                            <input type="text" name="bank_account_last_four" class="form-control mb-3" maxlength="4" placeholder="0000">

                            <x-button type="submit" color="primary" class="w-100">
                                <x-lucide-file-text class="w-4 h-4"/>
                                Generate Letter
                            </x-button>
                        </form>
                    </x-card>
                @endcan

                <x-card class="mt-3" title="Generated Documents">
                    @forelse($application->generatedDocuments->sortByDesc('generated_at') as $generatedDocument)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <strong>{{ $generatedDocument->typeLabel() }}</strong>
                                <small class="text-muted">{{ $generatedDocument->generated_at->format('d M Y') }}</small>
                            </div>
                            <div class="small text-muted mb-2">{{ $generatedDocument->document_number }}</div>
                            <a href="{{ route('loan-generated-documents.show', $generatedDocument) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                Open
                            </a>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No letters generated yet.</p>
                    @endforelse
                </x-card>

                @can('communications.send')
                    <x-card class="mt-3" title="Send Message">
                        <form action="{{ route('loan-applications.communications.store', $application) }}" method="POST">
                            @csrf

                            <label class="form-label">Template</label>
                            <select name="communication_template_id" class="form-select mb-3" required>
                                @foreach($communicationTemplates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>

                            <label class="form-label">Channel</label>
                            <select name="channel" class="form-select mb-3">
                                <option value="email">Email - {{ $application->customer->email ?? 'No email' }}</option>
                                <option value="whatsapp">WhatsApp - {{ $application->customer->mobile }}</option>
                            </select>

                            <label class="form-label">Subject Override</label>
                            <input type="text" name="subject" class="form-control mb-3" placeholder="Optional">

                            <label class="form-label">Message Override</label>
                            <textarea name="message" class="form-control mb-3" rows="4" placeholder="Optional. Leave blank to use template."></textarea>

                            <x-button type="submit" color="primary" class="w-100">
                                <x-lucide-send class="w-4 h-4"/>
                                Send / Log Message
                            </x-button>
                        </form>
                    </x-card>
                @endcan

                @can('leads.manage')
                    <x-card class="mt-3" title="Add Follow-up">
                        <form action="{{ route('loan-applications.follow-ups.store', $application) }}" method="POST">
                            @csrf
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select mb-3">
                                <option value="note">Note</option>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                                <option value="visit">Visit</option>
                            </select>

                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control mb-3" rows="4" required></textarea>

                            <label class="form-label">Next Follow-up</label>
                            <input type="datetime-local" name="next_follow_up_at" class="form-control mb-3">

                            <x-button type="submit" color="dark" class="w-100">Add Follow-up</x-button>
                        </form>
                    </x-card>
                @endcan

                <x-card class="mt-3" title="Follow-up History">
                    @forelse($application->followUps->sortByDesc('created_at') as $followUp)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <strong>{{ str($followUp->type)->headline() }}</strong>
                                <small class="text-muted">{{ $followUp->created_at->format('d M, h:i A') }}</small>
                            </div>
                            <p class="mb-1">{{ $followUp->note }}</p>
                            <small class="text-muted">
                                By {{ $followUp->user?->name ?? 'System' }}
                                @if($followUp->next_follow_up_at)
                                    - Next {{ $followUp->next_follow_up_at->format('d M Y, h:i A') }}
                                @endif
                            </small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No follow-ups added yet.</p>
                    @endforelse
                </x-card>

                <x-card class="mt-3" title="Communication History">
                    @forelse($application->communicationLogs->sortByDesc('created_at') as $communication)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <strong>{{ str($communication->channel)->headline() }}</strong>
                                <span class="badge text-bg-{{ $communication->status === 'failed' ? 'danger' : ($communication->status === 'sent' ? 'success' : 'secondary') }}">
                                    {{ str($communication->status)->headline() }}
                                </span>
                            </div>
                            <div class="small text-muted mb-2">
                                {{ $communication->recipient }} - {{ $communication->created_at->format('d M Y, h:i A') }}
                            </div>
                            @if($communication->subject)
                                <div class="fw-bold">{{ $communication->subject }}</div>
                            @endif
                            <p class="mb-1 small" style="white-space: pre-line;">{{ str($communication->message)->limit(220) }}</p>
                            @if($communication->error_message)
                                <small class="text-danger">{{ $communication->error_message }}</small>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">No messages sent yet.</p>
                    @endforelse
                </x-card>
            </div>
        </div>
    </div>
@endsection
