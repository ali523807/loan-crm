<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{
    public function index(Request $request): mixed
    {
        if ($request->ajax()) {
            $query = Customer::query()->withCount('loanApplications');

            $totalCount = Customer::query()->count();
            $filterCount = $query->clone()->count();

            $customers = $query
                ->latest('id')
                ->skip($request->start ?? 0)
                ->take($request->length ?? 10)
                ->get();

            return DataTables::of($customers)
                ->with([
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $filterCount,
                ])
                ->skipPaging()
                ->addIndexColumn()
                ->addColumn('applications', fn (Customer $customer): int => $customer->loan_applications_count)
                ->addColumn('created', fn (Customer $customer): string => $customer->created_at->format('d M Y'))
                ->addColumn('action', fn (Customer $customer): string => view('customers.columns._actions', compact('customer'))->render())
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customers.index');
    }

    public function show(Customer $customer): View
    {
        $customer->load(['loanApplications' => fn ($query) => $query->latest('id')]);

        return view('customers.show', compact('customer'));
    }
}
