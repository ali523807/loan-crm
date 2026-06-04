<?php

namespace App\Http\Controllers;

use App\Models\CommunicationLog;
use App\Models\LeadFollowUp;
use App\Models\LoanApplication;
use App\Models\LoanDocument;
use App\Models\LoanGeneratedDocument;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $statusCounts = LoanApplication::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', [
            'totalLeads' => LoanApplication::query()->count(),
            'totalCustomers' => LoanApplication::query()->distinct('customer_id')->count('customer_id'),
            'documentsPending' => LoanDocument::query()->whereIn('status', ['missing', 'rejected', 'pending'])->count(),
            'disbursedAmount' => LoanApplication::query()->where('status', 'disbursed')->sum('loan_amount'),
            'statusCounts' => $statusCounts,
            'todayFollowUps' => LeadFollowUp::query()
                ->with(['loanApplication.customer', 'user'])
                ->whereDate('next_follow_up_at', today())
                ->latest('next_follow_up_at')
                ->limit(6)
                ->get(),
            'overdueFollowUps' => LeadFollowUp::query()
                ->with(['loanApplication.customer', 'user'])
                ->whereNotNull('next_follow_up_at')
                ->where('next_follow_up_at', '<', now()->startOfDay())
                ->latest('next_follow_up_at')
                ->limit(6)
                ->get(),
            'documentIssues' => LoanDocument::query()
                ->with(['loanApplication.customer'])
                ->whereIn('status', ['missing', 'rejected'])
                ->latest('id')
                ->limit(8)
                ->get(),
            'recentLeads' => LoanApplication::query()
                ->with(['customer', 'assignedTo'])
                ->latest('id')
                ->limit(8)
                ->get(),
            'assignedLeads' => User::query()
                ->withCount('assignedLoanApplications')
                ->having('assigned_loan_applications_count', '>', 0)
                ->orderByDesc('assigned_loan_applications_count')
                ->limit(6)
                ->get(),
            'generatedDocumentsCount' => LoanGeneratedDocument::query()->count(),
            'communicationCount' => CommunicationLog::query()->count(),
        ]);
    }
}
