<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadFollowUpRequest;
use App\Http\Requests\StoreLoanDocumentRequest;
use App\Http\Requests\UpdateLoanApplicationStatusRequest;
use App\Http\Requests\UpdateLoanDocumentStatusRequest;
use App\Models\CommunicationTemplate;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class LoanApplicationsController extends Controller
{
    public function index(Request $request): mixed
    {
        if ($request->ajax()) {
            $query = LoanApplication::query()
                ->with(['customer', 'assignedTo'])
                ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
                ->when($request->filled('loan_type'), fn ($query) => $query->where('loan_type', $request->string('loan_type')));

            $totalCount = LoanApplication::query()->count();
            $filterCount = $query->clone()->count();

            $applications = $query
                ->latest('id')
                ->skip($request->start ?? 0)
                ->take($request->length ?? 10)
                ->get();

            return DataTables::of($applications)
                ->with([
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $filterCount,
                ])
                ->skipPaging()
                ->addIndexColumn()
                ->addColumn('customer', fn (LoanApplication $application): string => e($application->customer->full_name))
                ->addColumn('mobile', fn (LoanApplication $application): string => e($application->customer->mobile))
                ->addColumn('amount', fn (LoanApplication $application): string => 'Rs. '.number_format($application->loan_amount))
                ->addColumn('status_badge', fn (LoanApplication $application): string => view('loan-applications.columns._status', compact('application'))->render())
                ->addColumn('assigned_to', fn (LoanApplication $application): string => e($application->assignedTo?->name ?? 'Unassigned'))
                ->addColumn('submitted', fn (LoanApplication $application): string => $application->submitted_at?->format('d M Y') ?? '-')
                ->addColumn('action', fn (LoanApplication $application): string => view('loan-applications.columns._actions', compact('application'))->render())
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        $statusCounts = LoanApplication::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('loan-applications.index', [
            'statuses' => LoanApplication::STATUSES,
            'loanTypes' => LoanApplication::query()->distinct()->orderBy('loan_type')->pluck('loan_type'),
            'statusCounts' => $statusCounts,
            'totalLeads' => LoanApplication::query()->count(),
            'pendingDocuments' => (int) ($statusCounts['documents_pending'] ?? 0),
            'verifiedDocuments' => (int) ($statusCounts['documents_verified'] ?? 0),
            'disbursedLeads' => (int) ($statusCounts['disbursed'] ?? 0),
        ]);
    }

    public function show(LoanApplication $loanApplication): View
    {
        $loanApplication->load([
            'customer.loanApplications',
            'assignedTo',
            'documents.uploadedBy',
            'documents.verifiedBy',
            'followUps.user',
            'generatedDocuments.generatedBy',
            'communicationLogs.template',
            'communicationLogs.sentBy',
        ]);

        return view('loan-applications.show', [
            'application' => $loanApplication,
            'statuses' => LoanApplication::STATUSES,
            'admins' => User::query()->where('active', true)->orderBy('name')->get(),
            'communicationTemplates' => CommunicationTemplate::query()
                ->where('active', true)
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function updateStatus(UpdateLoanApplicationStatusRequest $request, LoanApplication $loanApplication): RedirectResponse
    {
        $loanApplication->update($request->validated());

        return back()->with('success', 'Lead status updated successfully.');
    }

    public function storeFollowUp(StoreLeadFollowUpRequest $request, LoanApplication $loanApplication): RedirectResponse
    {
        $loanApplication->followUps()->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Follow-up added successfully.');
    }

    public function storeDocument(StoreLoanDocumentRequest $request, LoanApplication $loanApplication): RedirectResponse
    {
        $data = $request->validated();
        $file = $request->file('document');
        $existingDocument = $loanApplication->documents()
            ->where('type', $data['type'])
            ->first();

        $path = $file->store("loan-documents/{$loanApplication->application_number}", 'public');

        $loanApplication->documents()->updateOrCreate(
            ['type' => $data['type']],
            [
                'uploaded_by_id' => $request->user()->id,
                'verified_by_id' => null,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'previous_path' => $existingDocument?->path,
                'status' => 'pending',
                'remarks' => $data['remarks'] ?? null,
                'verified_at' => null,
                'uploaded_at' => now(),
            ],
        );

        $loanApplication->update(['status' => 'documents_pending']);

        return back()->with('success', 'Document uploaded successfully and marked pending verification.');
    }

    public function updateDocumentStatus(
        UpdateLoanDocumentStatusRequest $request,
        LoanApplication $loanApplication,
        LoanDocument $loanDocument
    ): RedirectResponse {
        abort_unless($loanDocument->loan_application_id === $loanApplication->id, 404);

        $data = $request->validated();

        $loanDocument->update([
            'status' => $data['status'],
            'remarks' => $data['remarks'] ?? null,
            'verified_by_id' => $data['status'] === 'verified' ? $request->user()->id : null,
            'verified_at' => $data['status'] === 'verified' ? now() : null,
        ]);

        $loanApplication->load('documents');

        if ($loanApplication->documents->isNotEmpty() && $loanApplication->documents->every(fn (LoanDocument $document): bool => $document->status === 'verified')) {
            $loanApplication->update(['status' => 'documents_verified']);
        } elseif ($loanApplication->documents->contains(fn (LoanDocument $document): bool => in_array($document->status, ['missing', 'rejected'], true))) {
            $loanApplication->update(['status' => 'documents_pending']);
        }

        return back()->with('success', 'Document status updated successfully.');
    }
}
