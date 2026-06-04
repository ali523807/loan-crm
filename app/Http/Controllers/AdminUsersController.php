<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->with('roles');

            $totalCount = User::count();
            $filterCount = $users->clone()->count();

            $users = $users
                ->latest('id')
                ->skip($request->start ?? 0)
                ->take($request->length ?? 10)
                ->get();

            return DataTables::of($users)
                ->with([
                    'recordsTotal' => $totalCount,
                    'recordsFiltered' => $filterCount,
                ])
                ->skipPaging()
                ->addIndexColumn()
                ->addColumn('roles', fn (User $user): string => $user->roles->pluck('display_name')->join(', '))
                ->addColumn('status', fn (User $user): string => $user->active ? 'Active' : 'Inactive')
                ->addColumn('action', fn (User $user): string => view('admin-users.columns._actions', ['adminUser' => $user])->render())
                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::query()
            ->orderBy('display_name')
            ->get();

        return view('admin-users.index', compact('roles'));
    }

    public function storeOrUpdate(StoreAdminUserRequest $request)
    {
        $data = $request->validated();

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'active' => $request->boolean('active'),
        ];

        if (! empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $user = User::query()->updateOrCreate(
            ['id' => $data['id'] ?? null],
            $payload,
        );

        $user->roles()->sync($data['roles']);

        return response()->json(['message' => 'Admin user saved successfully!']);
    }

    public function edit(User $adminUser)
    {
        return response()->json([
            ...$adminUser->toArray(),
            'roles' => $adminUser->roles()->pluck('roles.id')->all(),
        ]);
    }

    public function destroy(User $adminUser)
    {
        abort_if($adminUser->is(auth()->user()), 403, 'You cannot delete your own account.');
        abort_if($adminUser->isSuperAdmin(), 403, 'Super Admin users cannot be deleted.');

        $adminUser->delete();

        return response()->json(['message' => 'Admin user deleted successfully!']);
    }
}
